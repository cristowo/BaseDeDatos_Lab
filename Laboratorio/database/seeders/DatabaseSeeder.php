<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Country;
use App\Models\CountrySongRestriction;
use App\Models\Genre;
use App\Models\Payment;
use App\Models\Permission;
use App\Models\Playlist;
use App\Models\PlaylistSong;
use App\Models\Rol;
use App\Models\RolPermission;
use App\Models\Song;
use App\Models\Ticket;
use App\Models\User;
use App\Models\UserFollow;
use App\Models\UserPlaylist;
use App\Models\UserSongLike;
use App\Models\UserSongListen;
use App\Models\UserSongRestrictionAge;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Permission::factory(20)->create();
        Country::factory(20)->create();
        Rol::factory(20)->create();
        User::factory(20)->create();
        Genre::factory(20)->create();
        Playlist::factory(20)->create();
        Song::factory(20)->create();
        Payment::factory(20)->create();
        Ticket::factory(20)->create();
        UserPlaylist::factory(20)->create();
        PlaylistSong::factory(20)->create();
        UserFollow::factory(20)->create();
        RolPermission::factory(20)->create();
        CountrySongRestriction::factory(20)->create();
        UserSongListen::factory(20)->create();
        UserSongLike::factory(20)->create();
        UserSongRestrictionAge::factory(20)->create();
    }
}
