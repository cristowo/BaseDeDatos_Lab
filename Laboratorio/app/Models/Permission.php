<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    public function rolpermission()
    {
    return $this->hasMany('App\Models\RolPermission');
    }
    use HasFactory;
}
