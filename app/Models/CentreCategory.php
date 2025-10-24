<?php

namespace App\Models;

use App\Observers\ActivityLogObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;

#[ObservedBy(ActivityLogObserver::class)]
class CentreCategory extends Model
{
    protected $fillable = [
        'name',
        'sort_order',
    ];
}