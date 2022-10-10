<?php

namespace Database\Factories;

use App\Models\Playlist;
use App\Models\Song;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PlaylistSong>
 */
class PlaylistSongFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //
            'id_playlist'=> Playlist::all()->random()->id,

            'id_song'=> Song::all()->random()->id
        ];
    }
}
