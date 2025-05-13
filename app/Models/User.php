<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Model
{
    public $timestamps = false;

    public function timestamps(): HasMany {
        return $this->hasMany(Timestamp::class);
    }
}
