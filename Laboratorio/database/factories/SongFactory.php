<?php

namespace Database\Factories;
use App\Models\Song;
use App\Models\Genre;
use App\Models\User;
use App\Models\Country;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Song>
 */
class SongFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->realText($maxNbChars = 20, $indexSize = 2),
            'date' => $this->faker->dateTime($max = 'now', $timezone = null),
            'collaborator' => $this->faker->name, 
            'reproduction' => $this->faker->randomNumber($nbDigits = NULL, $strict = false),
            'likes' => $this->faker->randomNumber($nbDigits = NULL, $strict = false),
            'duration' => $this->faker->numberBetween($min = 30,$max = 360),
            'link' => $this->faker->unique()->url,
            'id_genre' => Genre::all()->random()->id,
            'id_user' => User::all()->random()->id,
            'id_country' => Country::all()->random()->id,
            //
        ];
    }
}
