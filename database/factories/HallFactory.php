<?php

namespace Database\Factories;

use App\Models\Hall;
use Illuminate\Database\Eloquent\Factories\Factory;

class HallFactory extends Factory
{
    protected $model = Hall::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'capacity' => $this->faker->biasedNumberBetween(250, 300),
        ];
    }
}
