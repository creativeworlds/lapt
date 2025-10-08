<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Student;
use App\Services\AdmitCardService;
use App\Services\RegistrationLetterService;
use Illuminate\Http\Request;

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
        // $qrCode = QrCode::size(200)->generate(json_encode($certificate->student->only(['name', 'email', 'phone_number'])));
        // return view('certificates.show', compact('certificate', 'qrCode'));
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

    public function generatePdf(Certificate $certificate, AdmitCardService $admitCard, RegistrationLetterService $registrationLetter)
    {
        $admitCard->generate($certificate);
        $registrationLetter->generate($certificate);
        return back()->with('message', 'Genrate admit card successfully.');
    }
}