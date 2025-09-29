<?php

namespace App\Http\Controllers;

use App\Models\Centre;
use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::all();
        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $centres = Centre::all();
        return view('students.create', compact('centres'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        Student::create($req->all());
        return back()->with('message', 'Student created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        $courses = Course::whereCentreId($student->centre_id)->get();
        return view('students.show', compact('courses', 'student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        $centres = Centre::all();
        return view('students.edit', compact('student', 'centres'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $req, Student $student)
    {
        $student->update($req->all());
        return back()->with('message', 'Student updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return back()->with('message', 'Student deleted successfully.');
    }

    public function courseAllotment(Student $student, Request $req)
    {
        $student->courses()->syncWithoutDetaching([$req->course_id]);
        return back()->with('message', 'Student course allotted successfully.');
    }
}