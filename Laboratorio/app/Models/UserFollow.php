<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFollow extends Model
{

    public function user()      //userFollower
    {
    return $this->belongsTo('App\Models\User');
    }
    public function user1()        //userFollow
    {
    return $this->belongsTo('App\Models\User');
    }

    use HasFactory;
}
