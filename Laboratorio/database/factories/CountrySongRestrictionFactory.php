<?php

namespace Database\Factories;
use App\Models\CountrySongRestriction;
use App\Models\Country;
use App\Models\Song;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CountrySongRestrictionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id_country' => Country::all()->random()->id,
            'id_song' => Song::all()->random()->id,
            //
        ];
    }
}
