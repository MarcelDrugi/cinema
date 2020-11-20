<?php

namespace Database\Factories;

use App\Models\Pricing;
use Illuminate\Database\Eloquent\Factories\Factory;

class PricingFactory extends Factory
{
    protected $model = Pricing::class;

    public function definition()
    {
        return [
            'week_day' => $this->faker->unique()->randomElement([
                'Monday',
                'Tuesday',
                'Wednesday',
                'Thursday',
                'Friday',
                'Saturday',
                'Sunday',
            ]),
            'normal' => $this->faker->randomFloat(2, 15, 30),
            'school' => $this->faker->randomFloat(2, 12, 25),
            'senior' => $this->faker->randomFloat(2, 12, 25),
        ];
    }
}
