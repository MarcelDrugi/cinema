<?php

namespace Tests\Integration;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use App\Services\CreateUserService;
use App\Models\User;
use Spatie\Permission\Models\Role;

class CreateUserTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function create()
    {
        Role::create(['name' => 'customer']);
        
        $service = new CreateUserService('customer');
        
        $data =[
            'first_name' => 'Jan',
            'last_name' => 'Kowalski',
            'email' => 'jankowalski@example.com',
            'password' => 'SomePass',
        ];
        
        $service->createUser($data);
        
        $user = User::orderBy('id', 'desc')->first();
        
        $this->assertEquals($data['first_name'], $user->first_name);
        $this->assertEquals($data['last_name'], $user->last_name);
        $this->assertEquals($data['email'], $user->email);
        $this->assertTrue(Hash::check($data['password'], $user->password));
    }
}
