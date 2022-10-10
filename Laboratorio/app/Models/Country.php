<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
     // User
    public function user()
    {
    return $this->hasMany('App\Models\User');
    }

    public function song()
    {
    return $this->hasMany('App\Models\Song');
    }

    public function countrySongRestriction()
    {
    return $this->hasMany('App\Models\CountrySongRestriction');
    }

    use HasFactory;
}
