<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailLog extends Model
{
    protected $casts = [
        'from' => 'json',
        'cc' => 'json',
        'to' => 'json',
        'sent_at' => 'datetime',
    ];

    protected $fillable = [
        'from',
        'to',
        'cc',
        'subject',
        'body',
        'status',
        'error_message',
        'sent_at',
    ];

    public $timestamps = false;
}
