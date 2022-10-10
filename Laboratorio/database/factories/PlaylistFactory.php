<?php

namespace Database\Factories;

use App\Models\PlayList;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Playlist>
 */
class PlaylistFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'=> $this->faker->name,
            //'date'=> $this->faker->date,
            "songs"=> $this->faker->numberBetween($min = 1,$max = 100),
            "duration"=> $this->faker->numberBetween($min = 30,$max = 360), //Segundos
            'link' => $this->faker->url,
            'id_user'=> User::all()->random()->id
            //
        ];
    }
}
