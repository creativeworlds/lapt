<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Centre extends Model
{
    protected $fillable = [
        'category',
        'type',
        'name',
        'code',
        'address',
        'country',
        'state',
        'city',
        'contact_person',
        'mobile',
        'phone',
        'fax',
        'email',
        'description',
        'website',
        'facebook',
        'twitter',
        'instagram',
        'linkedin',
        'password',
        'chairman_signature',
        'examiner_signature',
        'center_logo',
    ];

    public function courses()
    {
        return $this->hasmany(Course::class);
    }
}