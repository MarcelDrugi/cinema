<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Spatie\Permission\Models\Role;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'email' => $this->faker->unique()->safeEmail,
            'first_name' => $this->faker->firstNameMale,
            'last_name' => $this->faker->lastName,
            'password' => $this->faker->password,
        ];
    }
    
    public function configure()
    {
        return $this->afterMaking(function (User $customerUser) {
            
            Role::updateOrCreate(['name' => 'customer']);
            
            Role::updateOrCreate(['name' => 'employee']);
            
            Role::updateOrCreate(['name' => 'admin']);
        });
    }
}
