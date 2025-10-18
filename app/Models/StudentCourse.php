<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentCourse extends Model
{
    protected $fillable = [
        'student_id',
        'course_id',
        'certificate_id',
        'registration_date',
        'payment',
        'payment_status',
        'start_date',
        'end_date',
        'course_status',
        'status'
    ];
}