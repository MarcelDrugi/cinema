<?php

namespace Database\Factories;

use App\Models\Hall;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Information;

class InformationFactory extends Factory
{
    protected $model = Information::class;

    public function definition()
    {
        $maxContentLength = $this->faker->numberBetween(30, 450);
        
        return [
            'place' => $this->faker->unique()->randomElement(Information::$availablePlaces),
            'max_length' => $maxContentLength,
            'content' => $this->faker->text($maxContentLength), 
        ];
    }
}
