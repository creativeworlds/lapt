<?php

namespace App\Services;

use App\Models\Certificate;
use Illuminate\Support\Facades\Storage;
use setasign\Fpdi\Fpdi;

class RegistrationLetterService
{
    public function generate(Certificate $certificate)
    {
        /** Image Template Path */
        $templatePath = public_path('images/registration_letter_template.jpg');

        /** Image Font Family Path */
        $fontPath = public_path('fonts/arialmtlight.ttf');

        // check template path
        if (!file_exists($templatePath))
            abort(500, 'Registration letter template missing: ' . $templatePath);

        // check fonts path
        if (!file_exists($fontPath))
            abort(500, 'Font not found: ' . $fontPath);

        /** Load template Image */
        $image = imagecreatefromjpeg($templatePath);

        $name = $certificate->student->name ?? '';
        $center_name = $certificate->student->centre->name ?? '';
        $student_id = $certificate->student->id;
        $certificate_title = preg_replace('/Code-\s*\d+\s*/', '', $certificate->course->name);
        $certificate_title = preg_replace('/code-\s*\d+\s*/', '', $certificate_title);
        $certificate_title = preg_replace('/\(Code\s*\d+\)/', '', $certificate_title);
        $certificate_title = preg_replace('/\(code\s*\d+\)/', '', $certificate_title);
        $certificate_title = preg_replace("/code-\d+-/", "", $certificate_title);
        $certificate_title = preg_replace("/code \d+-/", "", $certificate_title);
        $certificate_title = preg_replace("'/\scode-\d+\s/'", "", $certificate_title);
        $certificate_title = preg_replace("'/\scode\s/'", "", $certificate_title);

        // ✅ Convert to Title Case
        $line_one = trim(ucwords(strtolower($certificate_title)));
        $line_two = trim(ucwords(strtolower($center_name)));
        $line_three = trim(ucwords(strtolower($center_name)));

        $line1 = 'We are pleased to inform you that you have been enrolled in the ' . $line_one . ' program offered by ' . $line_two . '. This course will equip you with the skills and knowledge necessary to excel in your career.';
        $line2 = 'Once you complete your course, you will be required to appear for your assessment/exam on the LAPT Portal or at an accredited center. Please note that LAPT does not collect any fees directly from students, and all fees must be paid through its accredited training providers. This registration is subject to the terms and conditions mentioned on the LAPT website.';
        $line3 = 'To take the LAPT Assessment, you will need to have your LAPT issued Admit card, which we will email to your registered email address in both soft copy or printed form. Please keep it safe';
        $line4 = 'LAPT Ltd is a UK-based company that has been offering exams globally for 20 years. LAPT certifications are recognized by employers worldwide, and LAPT is an independent global certification body that awards certification based on its assessments/exams. Please review the terms and conditions on the LAPT website for more information.';
        $line5 = 'You have been enrolled at ' . $line_three . ', which is authorized to conduct LAPT exams at their academy.';
        $line6 = 'Thank you for choosing LAPT for your certification needs. If you have any further questions, please contact us at the email address provided below.';

        // colors
        $color = imagecolorallocate($image, 0, 0, 0);

        $width = 500;
        $x = 180;
        $y = 400;
        $words = explode(' ', $center_name);
        $text = '';
        foreach ($words as $word) {
            $teststring = $text . ' ' . $word;
            $bbox = imagettfbbox(30, 0, $fontPath, $teststring);
            $textwidth = $bbox[2] - $bbox[0];
            if ($textwidth > $width) {
                $text .= "\n" . $word;
            } else {
                $text .= ' ' . $word;
            }
        }

        $width1 = 1900;
        $x1 = 140;
        $y1 = 500;
        $words1 = explode(' ', $line1);
        $text1 = '';
        foreach ($words1 as $word1) {
            $teststring1 = $text1 . $word1 . ' ';
            $bbox1 = imagettfbbox(30, 0, $fontPath, $teststring1);
            $textwidth1 = $bbox1[2] - $bbox1[0];
            if ($textwidth1 > $width1) {
                $text1 .= "\n" . $word1 . ' ';
            } else {
                $text1 .= $word1 . ' ';
            }
        }

        $width2 = 1900;
        $x2 = 140;
        $y2 = 590;
        $words2 = explode(' ', $line2);
        $text2 = '';
        foreach ($words2 as $word2) {
            $teststring2 = $text2 . $word2 . ' ';
            $bbox2 = imagettfbbox(30, 0, $fontPath, $teststring2);
            $textwidth2 = $bbox2[2] - $bbox2[0];
            if ($textwidth2 > $width2) {
                $text2 .= "\n" . $word2 . ' ';
            } else {
                $text2 .= $word2 . ' ';
            }
        }

        $width3 = 1900;
        $x3 = 140;
        $y3 = 680;
        $words3 = explode(' ', $line3);
        $text3 = '';
        foreach ($words3 as $word3) {
            $teststring3 = $text3 . $word3 . ' ';
            $bbox3 = imagettfbbox(30, 0, $fontPath, $teststring3);
            $textwidth3 = $bbox3[2] - $bbox3[0];
            if ($textwidth3 > $width3) {
                $text3 .= "\n" . $word3 . ' ';
            } else {
                $text3 .= $word3 . ' ';
            }
        }

        $width4 = 1900;
        $x4 = 140;
        $y4 = 770;
        $words4 = explode(' ', $line4);
        $text4 = '';
        foreach ($words4 as $word4) {
            $teststring4 = $text4 . $word4 . ' ';
            $bbox4 = imagettfbbox(30, 0, $fontPath, $teststring4);
            $textwidth4 = $bbox4[2] - $bbox4[0];
            if ($textwidth4 > $width4) {
                $text4 .= "\n" . $word4 . ' ';
            } else {
                $text4 .= $word4 . ' ';
            }
        }

        $width5 = 1900;
        $x5 = 140;
        $y5 = 860;
        $words5 = explode(' ', $line5);
        $text5 = '';
        foreach ($words5 as $word5) {
            $teststring5 = $text5 . $word5 . ' ';
            $bbox5 = imagettfbbox(30, 0, $fontPath, $teststring5);
            $textwidth5 = $bbox5[2] - $bbox5[0];
            if ($textwidth5 > $width5) {
                $text5 .= "\n" . $word5 . ' ';
            } else {
                $text5 .= $word5 . ' ';
            }
        }

        $width6 = 1900;
        $x6 = 140;
        $y6 = 950;
        $words6 = explode(' ', $line6);
        $text6 = '';
        foreach ($words6 as $word6) {
            $teststring6 = $text6 . $word6 . ' ';
            $bbox6 = imagettfbbox(30, 0, $fontPath, $teststring6);
            $textwidth6 = $bbox6[2] - $bbox6[0];
            if ($textwidth6 > $width6) {
                $text6 .= "\n" . $word6 . ' ';
            } else {
                $text6 .= $word6 . ' ';
            }
        }

        $nameFontSize = 18;
        $nameLength = strlen($name);
        if ($nameLength > 20) {
            $nameFontSize = 15;
        }

        $centerTitleFontSize = 18;
        $centerTieleLength = strlen($center_name);
        if ($centerTieleLength > 45) {
            $centerTitleFontSize = 16;
        }

        imagettftext($image, $centerTitleFontSize, 0, $x, $y, $color, $fontPath, $text);
        imagettftext($image, 12, 0, $x1, $y1, $color, $fontPath, $text1);
        imagettftext($image, 12, 0, $x2, $y2, $color, $fontPath, $text2);
        imagettftext($image, 12, 0, $x3, $y3, $color, $fontPath, $text3);
        imagettftext($image, 12, 0, $x4, $y4, $color, $fontPath, $text4);
        imagettftext($image, 12, 0, $x5, $y5, $color, $fontPath, $text5);
        imagettftext($image, 12, 0, $x6, $y6, $color, $fontPath, $text6);
        imagettftext($image, $nameFontSize, 0, 190, 365, $color, $fontPath, $name);
        imagettftext($image, 20, 0, 730, 370, $color, $fontPath, $student_id);

        imagettftext($image, 20, 0, 690, 395, $color, $fontPath, $certificate->student->created_at->format('Y-m-d'));

        // make registration letter directory
        Storage::disk('public')->makeDirectory('registration_letter');

        $imageName = str_replace(" ", "_", $certificate->student->name) . "_" . date("y_m_d_H_i_s") . "_" . $certificate->student->id . ".jpg";
        $outputPath = public_path('storage/registration_letter/' . $imageName);

        // check registration letter image
        if (file_exists($outputPath))
            unlink($outputPath);

        // generate registration letter image
        imagejpeg($image, $outputPath);

        // get registration letter image height and width
        list($imageWidth, $imageHeight) = getimagesize($outputPath);

        $pdf = new \FPDF();
        $pdf->AddPage('P', [$imageWidth, $imageHeight]);

        $pdf->Image($outputPath, 0, 0, $imageWidth, $imageHeight);

        $certificateid = $certificate->id;

        // make student certificates directory
        Storage::disk('public')->makeDirectory('certificates');

        $cname = 'letter';
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

        // registration image convert to pdf
        $pdf->Output($target_path, "F");

        // gentare url for qrcode
        $f = str_replace(["{$certificate->course_id}_{$certificate->student_id}_{$certificate->id}_", '.pdf'], '', $newFileName);
        $cname = explode('_', $f);
        $cname = $cname[count($cname) - 1];

        // $urlFile = $url = "/admin/certificates/$file";

        $slug = "{$certificate->course_id}_{$certificate->student_id}_{$certificate->id}_{$cname}";
        $slug = str_rot13($slug);
        $slug = rtrim(strtr(base64_encode($slug), '+/', '-_'), '=');
        $url = url("/verification.php?verify=" . $slug);

        // apply qrCode inside registration letter
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

        $qrpngfile = "qrcode_" . time() . ".png";

        // make student qrcode directory
        Storage::disk('public')->makeDirectory('qrcode');
        $qrpng_path = public_path('storage/qrcode/' . $qrpngfile);

        \QRcode::png($url, $qrpng_path);

        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFont('arial', '', 1);

        if (preg_match('/letter/i', $fileName)) {
            $pdf->Image($qrpng_path, 50, 50, 180, 180);
            $pdf->SetFont('arial', '', 50);
            $pdf->SetXY(70, 50);
            $pdf->Write(0, "Scan to Verify");

        } else {
            die('Error! matching file name not found ...');
        }

        @unlink($qrpng_path);
        @unlink($target_path);
        $pdf->Output("F", $target_path);

        imagedestroy($image);

        return compact(['url', 'target_path']);
    }
}