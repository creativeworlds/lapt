<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CentreCourse extends Model
{
    protected $casts = [
        'fee' => 'float',
        'discount' => 'float',
        'fee_after_discount' => 'float',
        'tax_rate' => 'float',
        'tax_amount_included' => 'float',
        'amount_ex_tax' => 'date',
    ];

    protected $fillable = [
        'centre_id',
        'course_id',
        'fee',
        'discount',
        'fee_after_discount',
        'currency',
        'tax_type',
        'tax_rate',
        'tax_amount_included',
        'amount_ex_tax',
        'gst_mode',
    ];
}