<?php

namespace App\Http\Controllers;

use App\Models\Centre;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::all();
        return view('courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $centres = Centre::all();
        return view('courses.create', compact('centres'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        Course::create($req->all());
        return back()->with('message', 'Course created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        $centres = Centre::all();
        return view('courses.edit', compact('course', 'centres'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $req, Course $course)
    {
        $course->update($req->all());
        return back()->with('message', 'Course updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $course->delete();
        return back()->with('message', 'Course deleted successfully.');
    }
}