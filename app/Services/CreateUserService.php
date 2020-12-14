<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

final class CreateUserService
{
    private $role;
    
    public function __construct($role)
    {
        $this->role = $role;
    }
    
    public function createUser($data)
    {
        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        $user->assignRole($this->role);
        $user->save();
    }
}