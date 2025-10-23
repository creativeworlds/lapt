<?php

use App\Http\Controllers\CentreCategoryController;
use App\Http\Controllers\CentreController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\VerificationController;
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

Route::get('/verify/{code}', [VerificationController::class, 'verify'])->name('verify');
Route::resource('invoices', InvoiceController::class)->middleware('auth');

Route::get('students/{student}/memberships/create', [MembershipController::class, 'create'])->name('memberships.create')->middleware('auth');
Route::post('students/{student}/memberships', [MembershipController::class, 'store'])->name('memberships.store')->middleware('auth');
Route::delete('students/{student}/memberships', [MembershipController::class, 'delete'])->name('memberships.delete')->middleware('auth');

Route::get('students/{student}/courses/{course}/edit', [StudentController::class, 'editCourse'])->name('students.courses.edit')->middleware('auth');
Route::put('students/{student}/courses/{course}', [StudentController::class, 'updateCourse'])->name('students.courses.update')->middleware('auth');

Route::resource('centre-categories', CentreCategoryController::class)->middleware('auth');
Route::get('countries/{country}/states', [CountryController::class, 'getStates'])->middleware('auth')->name('countries.states');