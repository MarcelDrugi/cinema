<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        $customerUser = new User([
            'email' => 'jankowalski@example.com',
            'first_name' => 'Jan',
            'last_name' => 'Kowalski',
            'password' => bcrypt('somepass'),
        ]);
        $customerUser->assignRole('customer');
        $customerUser->save();
        
        $employeeUser = new User([
            'email' => 'janinamalinowska@example.com',
            'first_name' => 'Janina',
            'last_name' => 'Malinowska',
            'password' => bcrypt('somepass'),
        ]);
        $employeeUser->assignRole('employee');
        $employeeUser->save();
        
        $adminUser = new User([
            'email' => 'karolnowak@example.com',
            'first_name' => 'Karol',
            'last_name' => 'Nowak',
            'password' => bcrypt('somepass'),
        ]);
        $adminUser->assignRole('admin');
        $adminUser->save();
    }
}
