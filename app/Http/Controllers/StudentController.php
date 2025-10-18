<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentCourseRequest;
use App\Models\Centre;
use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $req)
    {
        $per_page = $req->per_page ?? 20;
        $search = $req->search ?? '';
        $totalStudents = Student::count();
        $students = Student::paginate($per_page);
        return view('students.index', compact(['students', 'totalStudents', 'per_page', 'search']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Centre $centre)
    {
        $centres = Centre::all();
        return view('students.create', compact('centre', 'centres'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        // store student photo
        $photo = $req->file('photo')->store('student_images', 'public');

        /** Create New Student */
        $student = Student::create([...$req->all(), ...compact('photo')]);

        // create student courses relationship
        $student->courses()->attach($req->course_id);

        return back()->with('message', 'Student created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        //
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

    public function editCourse(Student $student, Course $course)
    {
        $courses = Course::all();
        $course = $student->course($course);
        return view('students.courses.edit', compact(['course', 'courses', 'student']));
    }

    public function updateCourse(StudentCourseRequest $req, Student $student, Course $course)
    {
        // update student courses record
        $student->courses()->updateExistingPivot($course, $req->except(['_token', '_method', 'certificate_names']));

        // student course update flash message
        session()->flash('message', 'Student course updated successfully.');

        return response("<script>window.parent.tb_remove();window.parent.location.reload();</script>");
    }
}