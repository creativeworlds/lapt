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
        'member_card_status'
    ];

    public function centre()
    {
        return $this->belongsTo(Centre::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'student_courses')
            ->withPivot([
                'certificate_id',
                'registration_date',
                'payment',
                'payment_status',
                'start_date',
                'end_date',
                'course_status',
                'status'
            ]);
    }

    public function cardDeliveryDates()
    {
        return $this->hasMany(CardDeliveryDate::class);
    }

    public function getCardDeliveryDate($name, $status)
    {
        return optional(
            $this->cardDeliveryDates()->where(compact(['name', 'status']))->first()
        )->date?->format('d-m-Y') ?? '00-00-0000';
    }

    public function course(?Course $course = null)
    {
        return $this->courses()->when($course, fn($query) => $query->whereKey($course))->first();
    }
}