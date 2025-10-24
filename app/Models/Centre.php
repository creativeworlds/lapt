<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Centre extends Model
{
    protected $fillable = [
        'name',
        'code',
        'centre_category_id',
        'type',
        'address',
        'country_id',
        'state_id',
        'currency',
        'tax_type',
        'gst_number',
        'preferred_seller',
        'gst_mode',
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
        'chairman_sign',
        'examiner_sign',
        'logo',
    ];
}