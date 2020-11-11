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
            $customer = Role::create(['name' => 'customer']);
            $customer->save();
            
            $employee = Role::create(['name' => 'employee']);
            $employee->save();
            
            $admin = Role::create(['name' => 'admin']);
            $admin->save();
        });
    }
}
