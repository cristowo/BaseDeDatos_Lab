<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    public function country()
    {
    return $this->belongsTo('App\Models\Country');
    }

    public function genre()
    {
    return $this->belongsTo('App\Models\Genre');
    }

    public function user()
    {
    return $this->belongsTo('App\Models\User');
    }

    public function playlistsong()
    {
    return $this->hasMany('App\Models\PlaylistSong');
    }

    public function usersonglike()
    {
    return $this->hasMany('App\Models\UserSongLike');
    }

    public function usersonglisten()
    {
    return $this->hasMany('App\Models\UserSongListen');
    }

    public function usersongrestrictionage()
    {
    return $this->hasMany('App\Models\UserSongRestrictionAge');
    }

    public function countrysongrestriction()
    {
    return $this->hasMany('App\Models\CountrySongRestriction');
    }

    use HasFactory;
}
