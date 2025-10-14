<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class MembershipController extends Controller
{
    public function create(Student $student)
    {
        return view('memberships.create', compact('student'));
    }
}