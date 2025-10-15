<?php

namespace App\Http\Controllers;

use App\Http\Requests\MembershipRequest;
use App\Models\Student;
use App\Services\MembershipCardService;

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

        return back()->with('message', 'Membership card generated successfully.');
    }
}