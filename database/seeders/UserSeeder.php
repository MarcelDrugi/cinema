<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        $user1 = new User([
            'email' => 'jankowalski@example.com',
            'first_name' => 'Jan',
            'last_name' => 'Kowalski',
            'password' => bcrypt('somepass'),
        ]);
        $user1->assignRole('customer');
        $user1->save();
        
        $user2 = new User([
            'email' => 'janinamalinowska@example.com',
            'first_name' => 'Janina',
            'last_name' => 'Malinowska',
            'password' => bcrypt('somepass'),
        ]);
        $user2->assignRole('employee');
        $user2->save();
    }
}
