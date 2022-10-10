<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\UserFollow;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserFollow>
 */
class UserFollowFactory extends Factory
{
    protected $model = UserFollow::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition()
    {
        return [
            //
            'id_user'=> User::all()->random()->id,
            'id_user1'=> User::all()->random()->id,
        ];
    }
}
