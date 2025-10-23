<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = [
        'name',
        'iso_code_2',
        'iso_code_3',
        'address_format',
        'postcode',
        'status',
    ];

    public function states()
    {
        return $this->hasmany(State::class);
    }
}