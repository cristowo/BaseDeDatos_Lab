<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
	
	public function country()
    {
    return $this->belongsTo('App\Models\Country');
    }

    public function rol()
    {
    return $this->belongsTo('App\Models\Rol');
    }

    public function ticket()
    {
    return $this->hasMany('App\Models\Ticket');
    }

    public function playlist()
    {
    return $this->hasMany('App\Models\Playlist');
    }

    public function userfollower() //SEGUIDOR
    {
    return $this->hasMany('App\Models\UserFollow');
    }

    public function userfollowing() //SEGUIDO
    {
    return $this->hasMany('App\Models\UserFollow');
    }

    public function userplaylist()
    {
    return $this->hasMany('App\Models\UserPlaylist');
    }

    public function song()
    {
    return $this->hasMany('App\Models\Song');
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

    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
