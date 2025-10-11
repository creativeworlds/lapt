<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailLog extends Model
{
    protected $casts = [
        'cc_emails' => 'json',
        'sent_at' => 'datetime',
    ];

    protected $fillable = [
        'user_id',
        'student_id',
        'centre_id',
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
