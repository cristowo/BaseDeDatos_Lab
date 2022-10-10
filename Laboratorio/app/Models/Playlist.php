<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    use HasFactory;
    public function playlistSong()
    {
    return $this->hasMany('App\Models\PlaylistSong');
    }
    
    public function userPlaylist()
    {
    return $this->hasMany('App\Models\UserPlaylist');
    }
    
    public function user()
    {
    return $this->belongsTo('App\Models\User');
    }

}
