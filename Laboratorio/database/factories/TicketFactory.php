<?php

namespace Database\Factories;
use App\Models\Ticket;
use App\Models\User;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'amount' => $this->faker->randomElement($array = array ('3200','12600','24000')),
            'date' => $this->faker->dateTime($max = 'now', $timezone = null),
            'id_payment' => Payment::all()->random()->id,
            'id_user' => User::all()->random()->id,
            //
        ];
    }
}
