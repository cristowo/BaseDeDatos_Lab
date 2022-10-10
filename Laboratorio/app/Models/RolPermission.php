<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolPermission extends Model
{
    public function rol() 
    {
    return $this->belongsTo('App\Models\Rol');
    }
    public function permission() 
    {
    return $this->belongsTo('App\Models\Permission');
    }
    use HasFactory;
}
