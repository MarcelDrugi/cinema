<?php

namespace Database\Factories;

use App\Models\Term;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Screening;
use App\Models\Hall;
use App\Models\Pricing;

class TermFactory extends Factory
{
    protected $model = Term::class;

    public function definition()
    {
        return [
            'screening_id' => Screening::factory(),
            'hall_id' => Hall::factory(),
            'pricing_id' => Pricing::factory(),
            'date_time' => $this->faker->dateTimeBetween('now', '+1 years')->format('Y-m-d H:i'),
        ];
    }
}
