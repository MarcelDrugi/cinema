<?php


namespace Tests\Integration;

use App\Models\User;
use Tests\TestCase;
use App\Services\UpdateUserService;
use Illuminate\Support\Facades\Hash;


class UpdateUserTest extends TestCase
{
    
    /** @test */
    public function createContext()
    {
        $user = User::factory()->make();
        $user->assignRole('customer');  // Role is created by afterMaking() in 'UserFactory'.
        $user->save();
        
        $newUserData = [
            'first_name' => $user->first_name,
            'last_name' => 'NewLastname',
            'email' => $user->email,
            'password' => 'newPassword',
        ];
        $service = new UpdateUserService($user->id);
        $service->updateUser($newUserData);
        
        $user = User::find($user->id);  // User after data update.
        $this->assertEquals($newUserData['first_name'], $user->first_name);
        $this->assertEquals($newUserData['last_name'], $user->last_name);
        $this->assertEquals($newUserData['email'], $user->email);
        $this->assertTrue(Hash::check($newUserData['password'], $user->password));
    }
}