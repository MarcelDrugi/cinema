<?php

namespace Database\Factories;

use App\Models\Reservation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Screening;

class ReservationFactory extends Factory
{
    protected $model = Reservation::class;

    public function definition()
    {
        return [
            'screening_id' => Screening::factory(),
            'user_id' => User::factory(),
            'payment_status' => false,
            'price' => $this->faker->randomFloat(2, 40, 200),
            'tickets_number' => $this->faker->biasedNumberBetween(2, 8),
        ];
    }
}
