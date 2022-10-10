<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public function ticket()
    {
    return $this->hasMany('App\Models\Ticket');
    }

    use HasFactory;
}
