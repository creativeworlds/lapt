<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'centre_id',
        'course_id',
        'name',
        'care_of',
        'sex',
        'session',
        'photo',
        'id_card',
        'education_proof',
        'other_doc',
        'qualification',
        'telephone',
        'email',
        'mobile',
        'fax',
        'address_line',
        'details',
        'password',
    ];

    public function centre()
    {
        return $this->belongsTo(Centre::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function certificate() {
        return $this->hasOne(Certificate::class);
    }
}