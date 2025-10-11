<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CardDeliveryDate extends Model
{
    protected $casts = [
        'date' => 'date',
    ];

    protected $fillable = [
        "name",
        "student_id",
        "status",
        "date"
    ];

    public $timestamps = false;
}