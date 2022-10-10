<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlaylistSong extends Model
{
    use HasFactory;
    public function song()
    {
    return $this->belongsTo('App\Models\Song');
    }

    public function playlist()
    {
    return $this->belongsTo('App\Models\Playlist');
    }
}
