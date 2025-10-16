<?php

namespace App\Http\Controllers;

use App\Http\Requests\MembershipRequest;
use App\Mail\MembershipCardIssued;
use App\Models\Student;
use App\Services\MembershipCardService;
use Illuminate\Support\Facades\Mail;

class MembershipController extends Controller
{
    public function create(Student $student)
    {
        return view('memberships.create', compact('student'));
    }

    public function store(MembershipRequest $req, Student $student, MembershipCardService $membershipCardService)
    {
        // genrate membership card
        $membershipCard = $membershipCardService->generate($req->except('_token'), $student);

        // student member card status update 
        $student->update(['member_card_status' => 1]);

        // Send Student Email for Membership Card Issued
        Mail::to($student->email)->send(new MembershipCardIssued($membershipCard, $student));

        // Send Centre Email for Membership Card Issued
        Mail::to($student->centre->email)->send(new MembershipCardIssued($membershipCard, $student));

        // Send Admin Email for Document Issued
        // Mail::to('laptlondon@gmail.com')->send(new MembershipCardIssued($membershipCard, $student));

        return back()->with('message', 'Membership card generated successfully.');
    }
}