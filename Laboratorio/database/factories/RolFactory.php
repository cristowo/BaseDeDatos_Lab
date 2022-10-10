<?php

namespace Database\Factories;

use App\Models\Rol;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rol>
 */
class RolFactory extends Factory
{
    protected $model = Rol::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //
            'name' => $this->faker->randomElement($array = array ('administrador','cliente','artista')), 
            'description'=> $this->faker->realText($maxNbChars = 200, $indexSize = 2), 
        ];
    }
}
