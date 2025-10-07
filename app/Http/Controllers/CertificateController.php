<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Student;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use setasign\Fpdi\Fpdi;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $certificates = Certificate::all();
        return view('certificates.index', compact('certificates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = Student::all();
        return view('certificates.create', compact('students'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req, Student $student)
    {
        Certificate::create(['student_id' => $student->id, 'course_id' => $student->course->id]);
        return back()->with('message', 'Certificate created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Certificate $certificate)
    {
        $qrCode = QrCode::size(200)->generate(json_encode($certificate->student->only(['name', 'email', 'phone_number'])));
        return view('certificates.show', compact('certificate', 'qrCode'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Certificate $certificate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $req, Certificate $certificate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Certificate $certificate)
    {
        //
    }

    public function generatePdf(Certificate $certificate)
    {
        // // Generate QR as PNG with GD (works in PDF)
        // $png = QrCode::format('png')->size(200)->generate(json_encode($certificate->student->only(['name', 'email', 'phone_number'])));
        // $qrCode = base64_encode($png);

        // $pdf = Pdf::loadView('certificates.pdf', compact('certificate', 'qrCode'));
        // return $pdf->stream("{$certificate->student->name}_{$certificate->course->name}.pdf");

        // Load certificate with relations (adjust to your models)
        $certificate = Certificate::with(['student.centre', 'course'])->findOrFail($certificate->id);

        // Local paths (use public_path, not asset)
        $templatePath = public_path('images/id_card_template.jpeg');
        $fontPath = public_path('fonts/riverna_side.otf');

        if (!file_exists($templatePath)) {
            abort(500, 'ID card template missing: ' . $templatePath);
        }
        if (!file_exists($fontPath)) {
            abort(500, 'Font not found: ' . $fontPath);
        }

        // Load template image
        $image = imagecreatefromjpeg($templatePath);
        if (!$image) {
            abort(500, 'Could not create image from template.');
        }

        // Colors
        $black = imagecolorallocate($image, 0, 0, 0);
        $white = imagecolorallocate($image, 255, 255, 255);

        // Text positions & sizes
        $centerTitleFontSize = 40;
        $nameFontSize = 30;
        $fatherNameFontSize = 30;
        $certificateTitleFontSize = 30;

        $width = 500;

        // Example positions (x = left offset, y = baseline)
        $x = 396;
        $y = 50;


        $words = explode(' ', $certificate->student->centre->name);

        $text = '';

        foreach ($words as $word) {
            $teststring = $text . $word . ' ';
            $bbox = imagettfbbox(30, 0, $fontPath, $teststring);
            $textwidth = $bbox[2] - $bbox[0];
            if ($textwidth > $width) {
                $text .= "\n" . $word . ' ';
            } else {
                $text .= $word . ' ';
            }

        }

        $centerTitleFontSize = 40;
        $centerTieleLength = strlen($certificate->student->centre->name);
        if ($centerTieleLength > 80) {
            $centerTitleFontSize = 25;
        }

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
        imagettftext($image, $centerTitleFontSize, 0, $x, $y, $white, $fontPath, $text);
        imagettftext($image, $nameFontSize, 0, 390, 215, $black, $fontPath, $certificate->student->name);
        imagettftext($image, $fatherNameFontSize, 0, 390, 265, $black, $fontPath, $certificate->student->care_of);
        imagettftext($image, 30, 0, 390, 320, $black, $fontPath, $certificate->student->id);
        imagettftext($image, $certificateTitleFontSize, 0, 390, 375, $black, $fontPath, $certificate->course->name);
        imagettftext($image, 30, 0, 390, 430, $black, $fontPath, $certificate->student->session);

        // Prepare output directory
        $outDir = public_path('student_id_cards');

        // Make sure directory exists
        Storage::makeDirectory($outDir);

        // Sanitize filename
        $safeName = Str::slug($certificate->student->name ?: 'student', '_');
        $timestamp = date('y_m_d_H_i_s');
        $id = $certificate->student->id ?? '0';
        $imageName = "{$safeName}_{$timestamp}_{$id}.jpg";
        $outputPath = $outDir . DIRECTORY_SEPARATOR . $imageName;

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

        // Make sure directory exists
        $target_dir = public_path('certificates');

        Storage::makeDirectory($target_dir);

        $cname = 'admit';

        $newFileName = "{$certificate->course_id}_{$certificate->student_id}_{$certificateid}_{$cname}.pdf";
        $newFileName = strtolower($newFileName);
        $target_path = $target_dir . DIRECTORY_SEPARATOR . $newFileName;

        // Make sure directory exists
        $target_png_dir = public_path('certificates/png');

        Storage::makeDirectory($target_png_dir);

        $newFileNamePNG = "{$certificate->course_id}_{$certificate->student_id}_{$certificateid}_{$cname}.png";
        $newFileNamePNG = strtolower($newFileNamePNG);
        $target_path_png = $target_png_dir . DIRECTORY_SEPARATOR . $newFileNamePNG;

        if (file_exists($target_path_png)) {
            unlink($target_path_png);
        }

        if (file_exists($target_path)) {
            unlink($target_path);
        }

        $pdf->Output($target_path, 'F');

        imagedestroy($image);

        // Return as download (or you can stream inline with response()->file)
        // return response()->download($outputPath);
    }
}