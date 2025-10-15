<?php

namespace App\Services;

use App\Models\Student;
use App\Support\Facades\QRCode;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MembershipCardService
{
    public function generate($dateBetween, Student $student)
    {
        /** Image Template Path */
        $templatePath = public_path('images/membership_card_template.jpeg');

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

        /** Membership Card Name */
        $membershipCardName = $student->certificate->course->member_card_name;

        /** Font Size */
        $fontSize = 20;

        $originalFontSize = 25;
        $wordCount = str_word_count($membershipCardName);
        $newFontSize = ($wordCount > 4) ? 25 : $originalFontSize;

        // break text into lines
        $words = explode(' ', $membershipCardName);
        $lines = [];
        $currentLine = '';

        foreach ($words as $word):
            (strlen($currentLine . $word) <= 20)
                ? $currentLine .= $word . ' '
                : ($lines[] = trim($currentLine)) && ($currentLine = $word . ' ');
        endforeach;

        $lines[] = trim($currentLine);
        $membershipCardNameWrapped = implode("\n", $lines);

        // Draw the rest (left-aligned)
        imagettftext($image, $newFontSize, 0, 350, 125, $white, $fontPath, $membershipCardName ? $membershipCardNameWrapped : 'Membership Card');
        imagettftext($image, $fontSize, 0, 400, 265, $black, $fontPath, $student->name);
        imagettftext($image, $fontSize, 0, 400, 312, $black, $fontPath, "{$dateBetween['starting_date']} to {$dateBetween['completion_date']}");
        imagettftext($image, $fontSize, 0, 400, 350, $black, $fontPath, $student->certificate->id);
        imagettftext($image, $fontSize - 5, 0, 400, 385, $black, $fontPath, $student->certificate->course->name);

        // make student membership cards directory
        Storage::disk('public')->makeDirectory('membership_cards');

        // Sanitize filename
        $safeName = Str::slug($student->name ?? 'student', '_');
        $timestamp = date('y_m_d_H_i_s');
        $id = $student->id ?? '0';
        $imageName = "{$safeName}_{$timestamp}_{$id}.jpg";
        $outputPath = public_path('storage/membership_cards/' . $imageName);

        // $photo stores relative path like "student_images/abc.jpg" or null
        $photo = $student->photo;

        // Get full filesystem path to the file
        $student_photo_path = public_path('storage/' . $photo);

        // check student photo
        if (!file_exists($student_photo_path))
            die("Student photo is missing");

        $student_photo_type = exif_imagetype($student_photo_path);

        switch ($student_photo_type) {
            case IMAGETYPE_JPEG:
                $student_photo = imagecreatefromjpeg($student_photo_path);
                break;
            case IMAGETYPE_PNG:
                $student_photo = imagecreatefrompng($student_photo_path);
                break;
        }

        // student photo height and width
        $student_photo_width = imagesx($student_photo);
        $student_photo_height = imagesy($student_photo);

        // resize student photo
        $resizedImage = imagecreatetruecolor(150, 150);

        // check student photo resize 
        if (!$resizedImage)
            die("Failed to create a new blank image.");

        // student photo copy sample image
        $copyImage = imagecopyresampled($resizedImage, $student_photo, 0, 0, 0, 0, 150, 150, $student_photo_width, $student_photo_height);

        // check student copy photo
        if (!$copyImage)
            die("Image resize failed.");

        // make student membership cards temp directory
        Storage::disk('public')->makeDirectory('membership_cards/temp/');

        // student photo resize save path
        $savePath = public_path('storage/membership_cards/temp/resized_image.png');

        // resize image save
        $imageResize = imagepng($resizedImage, $savePath);

        // check image resize
        if (!$imageResize)
            die("Failed to save the resized image to the file.");

        // apply resize student photo 
        imagecopy($image, imagecreatefrompng($savePath), 860, 70, 0, 0, 150, 150);

        $cname = 'membership';
        $newFileName = "{$student->certificate->course_id}_{$student->id}_{$student->certificate->id}_{$cname}.pdf";
        $newFileName = strtolower($newFileName);
        $target_path = public_path('storage/certificates/' . $newFileName);

        // apply qrcode image
        imagecopy($image, imagecreatefrompng(QRCode::url($newFileName)->generate()->getpath()), 450, 437, 0, 0, 112, 112);

        // remove previous image
        if (file_exists($outputPath))
            unlink($outputPath);

        // Save image (quality 90)
        imagejpeg($image, $outputPath, 90);

        // convert membership card image to pdf
        list($imageWidth, $imageHeight) = getimagesize($outputPath);

        $pdf = new \FPDF();
        $pdf->AddPage('L', [$imageWidth, $imageHeight]);
        $pdf->Image($outputPath, 0, 0, $imageWidth, $imageHeight);
        $pdf->Output("F", $target_path);

        // delete qrcode image
        QRCode::delete();
        imagedestroy($image);

        return (object) [
            'url' => QRCode::getUrl(),
            'path' => asset('storage/certificates/' . $newFileName)
        ];
    }
}