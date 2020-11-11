<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        Role::create(['name' => 'customer']);
        
        Role::create(['name' => 'employee']);
        
        Role::create(['name' => 'admin']);
    }
}
