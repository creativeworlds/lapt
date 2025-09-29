<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['name', 'email', 'phone_number', 'centre_id'];

    public function centre()
    {
        return $this->belongsTo(Centre::class);
    }
}
