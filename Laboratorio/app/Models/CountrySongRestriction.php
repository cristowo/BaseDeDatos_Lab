<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CountrySongRestriction extends Model
{
    public function country()
    {
    return $this->belongsTo('App\Models\County');
    }

    public function song()
    {
    return $this->belongsTo('App\Models\Song');
    }

    use HasFactory;
}
