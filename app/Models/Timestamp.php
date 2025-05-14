<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Timestamp extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'check_in',
        'check_out',
        'has_checked_in',
        'has_checked_out',
        'latitude_check_in',
        'latitude_check_out',
        'longitude_check_in',
        'longitude_check_out',
        'user_id',
    ];
}
