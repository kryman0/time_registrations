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
        'latitude',
        'longitude',
        'user_id',
    ];
}
