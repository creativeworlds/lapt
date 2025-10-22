<?php

namespace App\Models;

use App\Enums\InvoiceType;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $casts = [
        'invoice_type' => InvoiceType::class,
        'amount' => 'float',
        'discount' => 'float',
        'fee_after_discount' => 'float',
        'tax' => 'float',
        'final_amount' => 'float',
        'due_date' => 'date',
    ];

    protected $fillable = [
        'invoice_type',
        'centre_id',
        'course_id',
        'amount',
        'discount',
        'fee_after_discount',
        'currency',
        'tax',
        'final_amount',
        'quantity',
        'due_date',
        'emi',
        'notes',
    ];
}