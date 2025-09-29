<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseStudent extends Model
{
    protected $fillable = ['course_id', 'student_id'];

    public $timestamps = false;
}