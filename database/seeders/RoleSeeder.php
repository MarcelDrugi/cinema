<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $customer = Role::create(['name' => 'customer']);
        $customer->save();
        
        $employee = Role::create(['name' => 'employee']);
        $employee->save();
        
        $admin = Role::create(['name' => 'admin']);
        $admin->save();
    }
}
