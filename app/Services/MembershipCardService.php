<?php

namespace App\Services;

use App\Models\Student;
use App\Support\Facades\QRCode;
use Illuminate\Support\Facades\Storage;

class MembershipCardService
{
    public function generate($dateBetween, Student $student)
    {
        // make student membership cards directory
        Storage::disk('public')->makeDirectory('certificates/png');

        /** Output Directory Path */
        $outputPath = public_path("storage/certificates");

        /** Membership Card File Name */
        $fileName = strtolower("{$student->certificate->course_id}_{$student->id}_{$student->certificate->id}_membership");

        /** Student Photo Path */
        $studentPhotoPath = public_path("storage/{$student->photo}");

        /** Image Template Path */
        $templatePath = public_path('images/membership_card_template.jpeg');

        /** Image Font Family Path */
        $fontPath = public_path('fonts/riverna_side.otf');

        /** Load Template Image */
        $image = imagecreatefromjpeg($templatePath);

        /** Image Allocate Black Color */
        $black = imagecolorallocate($image, 0, 0, 0);

        /** Image Allocate White Color */
        $white = imagecolorallocate($image, 255, 255, 255);

        /** Membership Card Name */
        $membershipCardName = $student->certificate->course->member_card_name;

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
        imagettftext($image, 25, 0, 350, 125, $white, $fontPath, $membershipCardName ? $membershipCardNameWrapped : 'Membership Card');
        imagettftext($image, 20, 0, 400, 265, $black, $fontPath, $student->name);
        imagettftext($image, 20, 0, 400, 312, $black, $fontPath, "{$dateBetween['starting_date']} to {$dateBetween['completion_date']}");
        imagettftext($image, 20, 0, 400, 350, $black, $fontPath, $student->certificate->id);
        imagettftext($image, 15, 0, 400, 385, $black, $fontPath, $student->certificate->course->name);

        $student_photo_type = exif_imagetype($studentPhotoPath);

        switch ($student_photo_type):
            case IMAGETYPE_JPEG:
                $student_photo = imagecreatefromjpeg($studentPhotoPath);
                break;
            case IMAGETYPE_PNG:
                $student_photo = imagecreatefrompng($studentPhotoPath);
                break;
        endswitch;

        // student photo height and width
        $student_photo_width = imagesx($student_photo);
        $student_photo_height = imagesy($student_photo);

        // resize student photo
        $resizedImage = imagecreatetruecolor(150, 150);

        // student photo copy sample image
        imagecopyresampled($resizedImage, $student_photo, 0, 0, 0, 0, 150, 150, $student_photo_width, $student_photo_height);

        // student photo resize save path
        $studentPhotoResize = public_path('storage/resized.png');

        // resize image save
        imagepng($resizedImage, $studentPhotoResize);

        // apply resize student photo 
        imagecopy($image, imagecreatefrompng($studentPhotoResize), 860, 70, 0, 0, 150, 150);

        // apply qrcode image
        imagecopy($image, imagecreatefrompng(QRCode::url($fileName)->generate()->getpath()), 450, 437, 0, 0, 112, 112);

        /** Output Image File Path */
        $pngPath = "{$outputPath}/png/{$fileName}.jpg";

        // Save image (quality 90)
        imagejpeg($image, $pngPath, 90);

        // convert membership card image to pdf
        list($imageWidth, $imageHeight) = getimagesize($pngPath);

        $pdf = new \FPDF();
        $pdf->AddPage('L', [$imageWidth, $imageHeight]);
        $pdf->Image($pngPath, 0, 0, $imageWidth, $imageHeight);
        $pdf->Output("F", "{$outputPath}/{$fileName}.pdf");

        // delete qrcode image
        QRCode::delete();

        // load template image destroy
        imagedestroy($image);

        return (object) [
            'url' => QRCode::getUrl(),
            'path' => asset("storage/certificates/{$fileName}.pdf")
        ];
    }
}