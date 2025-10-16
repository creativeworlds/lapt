<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['centre_id', 'name', 'code', 'member_card_name'];

    public function centre()
    {
        return $this->belongsTo(Centre::class);
    }
}