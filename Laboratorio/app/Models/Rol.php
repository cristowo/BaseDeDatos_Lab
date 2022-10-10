<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    public function rolpermission()
    {
    return $this->hasMany('App\Models\RolPermission');
    }
	
    public function user()
    {
    return $this->hasMany('App\Models\User');
    }
    
    use HasFactory;
}
