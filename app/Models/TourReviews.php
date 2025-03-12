<?php

namespace App\Models;

use App\Casts\DateCast;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class TourReviews extends Model
{
    protected $guarded = [];


    protected $casts = [
        'created_at' => DateCast::class
    ];

    //
}
