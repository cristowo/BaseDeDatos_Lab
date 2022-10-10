<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPlaylist extends Model
{
    use HasFactory;
    public function user()
    {
    return $this->belongsTo('App\Models\User');
    }
    public function playlist()
    {
    return $this->belongsTo('App\Models\Playlist');
    }
}
