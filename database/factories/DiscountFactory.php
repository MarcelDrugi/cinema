<?php

namespace Database\Factories;

use App\Models\Discount;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class DiscountFactory extends Factory
{
    protected $model = Discount::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'code' => $this->faker->bothify('################'), 
            'value' => $this->faker->randomFloat(2, 0.01, 0.99),
        ];
    }
}
