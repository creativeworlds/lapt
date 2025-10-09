<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailLog extends Model
{
    protected $casts = [
        'gmail_address' => 'json',
        'cc_emails' => 'json',
        'to_email' => 'json',
        'sent_at' => 'datetime',
    ];

    protected $fillable = [
        'gmail_address',
        'to_email',
        'cc_emails',
        'subject',
        'message',
        'status',
        'error_message',
        'sent_at',
    ];

    public $timestamps = false;
}
