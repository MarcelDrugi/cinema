<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        $customer_user = new User([
            'email' => 'jankowalski@example.com',
            'first_name' => 'Jan',
            'last_name' => 'Kowalski',
            'password' => bcrypt('somepass'),
        ]);
        $customer_user->assignRole('customer');
        $customer_user->save();
        
        $employee_user = new User([
            'email' => 'janinamalinowska@example.com',
            'first_name' => 'Janina',
            'last_name' => 'Malinowska',
            'password' => bcrypt('somepass'),
        ]);
        $employee_user->assignRole('employee');
        $employee_user->save();
        
        $admin_user = new User([
            'email' => 'karolnowak@example.com',
            'first_name' => 'Karol',
            'last_name' => 'Nowak',
            'password' => bcrypt('somepass'),
        ]);
        $admin_user->assignRole('admin');
        $admin_user->save();
    }
}
