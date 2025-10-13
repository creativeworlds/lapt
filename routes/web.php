<?php

use App\Http\Controllers\CentreController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

// breeze authentication routes
require __DIR__ . '/auth.php';

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::resource('centres', CentreController::class)->middleware('auth');
Route::resource('centres.students', StudentController::class)->middleware('auth');
Route::get('centres/{centre}/courses', [CentreController::class, 'getCentreCourses'])->middleware('auth')->name('centre.courses');
Route::resource('courses', CourseController::class)->middleware('auth');
Route::resource('students', StudentController::class)->middleware('auth');
Route::resource('students.certificates', CertificateController::class)->middleware('auth');
Route::resource('certificates', CertificateController::class)->middleware('auth');
Route::get('certificates/{certificate}/pdf', [CertificateController::class, 'generatePdf'])->name('certificate.pdf')->middleware('auth');

Route::view('verify/{fileName}', 'verification')->name('verify');