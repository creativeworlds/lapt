<?php

namespace App\Http\Controllers;

use App\Http\Requests\MembershipRequest;
use App\Models\Student;

class MembershipController extends Controller
{
    public function create(Student $student)
    {
        return view('memberships.create', compact('student'));
    }

    public function store(MembershipRequest $req, Student $student)
    {
        return back()->with('message', 'Membership card generated successfully.');
    }
}