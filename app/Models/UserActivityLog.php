<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserActivityLog extends Model
{
    protected $casts = [
        'old_value' => 'json',
        'new_value' => 'json',
    ];

    protected $fillable = [
        'module_name',
        'user_id',
        'action_type',
        'action_details',
        'old_value',
        'new_value'
    ];
}