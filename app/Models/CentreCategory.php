<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CentreCategory extends Model
{
    protected $fillable = [
        'name',
        'sort_order',
    ];
}