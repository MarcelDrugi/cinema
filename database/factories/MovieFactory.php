<?php

namespace Database\Factories;

use App\Models\Movie;
use Illuminate\Database\Eloquent\Factories\Factory;

class MovieFactory extends Factory
{
    protected $model = Movie::class;

    public function definition()
    {
        return [
            'title' => $this->faker->paragraph(1),
            'description' => $this->faker->paragraph(3),
            'published' => $this->faker->year,
            'time' => $this->faker->biasedNumberBetween(60, 340),
            'age_limit' => $this->faker->randomElement([0, 12, 15, 18]),
            'new_movie' => $this->faker->randomElement([true, false]),
        ];
    }
}
