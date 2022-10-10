<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSongRestrictionAge extends Model
{
    use HasFactory;
    public function user()
    {
    return $this->belongsTo('App\Models\User');
    }

    public function song()
    {
    return $this->belongsTo('App\Models\Song');
    }
}
