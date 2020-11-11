<?php

namespace Database\Factories;

use App\Models\Movie;
use App\Models\Screening;
use Illuminate\Database\Eloquent\Factories\Factory;

class ScreeningFactory extends Factory
{
    protected $model = Screening::class;
    
    public function definition()
    {
        return [
            'movie_id' => Movie::factory(),
            'viewers' => $this->faker->biasedNumberBetween(0, 120),
        ];
    }
}
