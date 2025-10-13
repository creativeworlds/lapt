<?php

namespace App\Services;

use App\Models\Certificate;
use App\Support\Facades\QRCode;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use setasign\Fpdi\Fpdi;

class AdmitCardService
{
    public function generate(Certificate $certificate)
    {
        /** Image Template Path */
        $templatePath = public_path('images/id_card_template.jpeg');

        /** Image Font Family Path */
        $fontPath = public_path('fonts/riverna_side.otf');

        // check template path
        if (!file_exists($templatePath))
            abort(500, 'ID card template missing: ' . $templatePath);

        // check fonts path
        if (!file_exists($fontPath))
            abort(500, 'Font not found: ' . $fontPath);

        /** Load template Image */
        $image = imagecreatefromjpeg($templatePath);

        // check load image
        if (!$image)
            abort(500, 'Could not create image from template.');

        /** Image Allocate Black Color */
        $black = imagecolorallocate($image, 0, 0, 0);

        /** Image Allocate White Color */
        $white = imagecolorallocate($image, 255, 255, 255);

        /** Centre Name Text */
        $centreNameText = '';

        foreach (explode(' ', $certificate->student->centre->name) as $word):

            /** Centre Name Text Box */
            $textBox = imagettfbbox(30, 0, $fontPath, $centreNameText . $word . ' ');

            $centreNameText .= $textBox[2] - $textBox[0] > 340 ? "\n" . $word . ' ' : $word . ' ';
        endforeach;

        /** Centre Name Font Size */
        $centerNameFontSize = strlen($certificate->student->centre->name) > 80 ? 25 : 40;

        /** Name Font Size */
        $nameFontSize = 30;
        $nameLength = strlen($certificate->student->name);
        if ($nameLength > 39 && $nameLength <= 60) {
            $nameFontSize = 23;
        } elseif ($nameLength > 60) {
            $nameFontSize = 15;
        }

        $fatherNameFontSize = 30;
        $fatherNameLength = strlen($certificate->student->care_of);
        if ($fatherNameLength > 23 && $fatherNameLength <= 48) {
            $fatherNameFontSize = 22;
        } elseif ($fatherNameLength > 48) {
            $fatherNameFontSize = 20;
        }

        $certificateTitleFontSize = 30;
        $certificateTitleLength = strlen($certificate->course->name);
        if ($certificateTitleLength > 35 && $certificateTitleLength <= 72) {
            $certificateTitleFontSize = 22;
        } elseif ($certificateTitleLength > 72) {
            $certificateTitleFontSize = 18;
            $certificate_title = substr($certificate->course->name, 0, 90);
        }

        // Draw the rest (left-aligned)
        imagettftext($image, $centerNameFontSize, 0, 396, 50, $white, $fontPath, $centreNameText);
        imagettftext($image, $nameFontSize, 0, 390, 215, $black, $fontPath, $certificate->student->name);
        imagettftext($image, $fatherNameFontSize, 0, 390, 265, $black, $fontPath, $certificate->student->care_of);
        imagettftext($image, 30, 0, 390, 320, $black, $fontPath, $certificate->student->id);
        imagettftext($image, $certificateTitleFontSize, 0, 390, 375, $black, $fontPath, $certificate->course->name);
        imagettftext($image, 30, 0, 390, 430, $black, $fontPath, $certificate->student->session);

        // make student id cards directory
        Storage::disk('public')->makeDirectory('student_id_cards');

        // Sanitize filename
        $safeName = Str::slug($certificate->student->name ?: 'student', '_');
        $timestamp = date('y_m_d_H_i_s');
        $id = $certificate->student->id ?? '0';
        $imageName = "{$safeName}_{$timestamp}_{$id}.jpg";
        $outputPath = public_path('storage/student_id_cards/' . $imageName);

        // $photo stores relative path like "student_images/abc.jpg" or null
        $photo = $certificate->student->photo;

        // Get full filesystem path to the file
        $student_photo_path = public_path('storage/' . $photo);

        // return  $student_photo_path;

        if (!file_exists($student_photo_path)) {
            die("Student photo is missing");
        }

        $student_photo_type = exif_imagetype($student_photo_path);

        switch ($student_photo_type) {
            case IMAGETYPE_JPEG:
                $student_photo = imagecreatefromjpeg($student_photo_path);
                break;
            case IMAGETYPE_PNG:
                $student_photo = imagecreatefrompng($student_photo_path);
                break;
        }

        $absolute_path = realpath($student_photo_path);

        if (!$absolute_path) {
            die("Student photo is missing");
        }

        $student_photo_orientation = new \Imagick($absolute_path);

        $orientation = $student_photo_orientation->getImageOrientation();

        switch ($orientation) {
            case 3:
                $student_photo = imagerotate($student_photo, 180, 0);
                break;
            case 6:
                $student_photo = imagerotate($student_photo, -90, 0);
                break;
            case 8:
                $student_photo = imagerotate($student_photo, 90, 0);
                break;
        }

        $student_photo_resized = imagescale($student_photo, 187, 227);

        $student_photo_width = imagesx($student_photo_resized);
        $student_photo_height = imagesy($student_photo_resized);

        $student_photo_x = imagesx($image) - $student_photo_width - 0;
        $student_photo_y = imagesy($image) - $student_photo_height - 377;

        imagecopy($image, $student_photo_resized, $student_photo_x, $student_photo_y, 0, 0, $student_photo_width, $student_photo_height);

        if (file_exists($outputPath)) {
            unlink($outputPath);
        }

        // Save image (quality 90)
        imagejpeg($image, $outputPath, 90);

        // Free resources
        // imagedestroy($image);

        $imageWidth = 90;
        $imageHeight = 54;

        $pdf = new \FPDF();
        $pdf->AddPage('L', [$imageWidth + 4, $imageHeight + 4]);
        $pdf->Image($outputPath, 2, 2, $imageWidth, $imageHeight);

        $certificateid = $certificate->id;

        // make student certificates directory
        Storage::disk('public')->makeDirectory('certificates');

        $cname = 'admit';
        $newFileName = "{$certificate->course_id}_{$certificate->student_id}_{$certificateid}_{$cname}.pdf";
        $newFileName = strtolower($newFileName);
        $target_path = public_path('storage/certificates/' . $newFileName);

        // make student certificates png directory
        Storage::disk('public')->makeDirectory('certificates/png');

        $newFileNamePNG = "{$certificate->course_id}_{$certificate->student_id}_{$certificateid}_{$cname}.png";
        $newFileNamePNG = strtolower($newFileNamePNG);
        $target_path_png = public_path('storage/certificates/png/' . $newFileNamePNG);

        if (file_exists($target_path_png)) {
            unlink($target_path_png);
        }

        if (file_exists($target_path)) {
            unlink($target_path);
        }

        $pdf->Output($target_path, 'F');

        /** Genrate qrcode image path */
        $qrCodePath = QRCode::url($newFileName)->generate()->getPath();

        // apply qrcode inside admit card
        $pdf = new Fpdi();
        $pdf->setSourceFile($target_path);
        $tplIdx = $pdf->importPage(1);
        $size = $pdf->getTemplateSize($tplIdx);
        $pdf->AddPage();
        $pdf->useTemplate($tplIdx, null, null, $size['width'], $size['height'], true);

        $fileName = basename($target_path);
        if (preg_match('/marksheet|admit|letter|certificate/', $fileName) != true) {
            die('Error! matching file name not found ...');
        }

        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFont('arial', '', 12);
        if (preg_match('/admit/i', $fileName)) {
            $pdf->Image($qrCodePath, 40, 41.5, 9.8);
        } else {
            die('Error! matching file name not found ...');
        }

        // delete qrcode image
        QRCode::delete();
        @unlink($target_path);
        $pdf->Output("F", $target_path);

        imagedestroy($image);

        return (object) [
            'url' => QRCode::getUrl(),
            'path' => $target_path
        ];
    }
}