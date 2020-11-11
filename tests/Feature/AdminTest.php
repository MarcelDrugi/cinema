<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use RefreshDatabase;
    
    protected $url = '/admin';
    
    /** @test */
    public function redirectNotLoggedInUser()
    {
        $response = $this->get($this->url);
        $response->assertStatus(302);
        $response->assertRedirect('/login');
        
        $this->followingRedirects()
            ->get($this->url)
            ->assertStatus(200);
    }
    
    /** @test */
    public function redirectUserWithoutPermission()
    {        
        $user = User::factory()->make();
        $user->assignRole('customer');  // Role is created by afterMaking() in 'UserFactory'.
        $user->save();
        
        $response = $this->actingAs($user)->get($this->url);
        $response->assertStatus(302);
        $response->assertRedirect('/noperm/admin');
        
        $this->followingRedirects()
            ->get($this->url)
            ->assertStatus(200);
    }
    
    /** @test */
    public function createEmploeeAccount()
    {
        $user = User::factory()->make();
        $user->assignRole('admin');
        $user->save();
        
        $body = [
            'first_name' => 'Some',
            'last_name' => 'Emploee',
            'email' => 'someemploee@example.com',
            'password' => 'somepass',
            'password_confirmation' => 'somepass',
        ];
        $response = $this->actingAs($user)->post($this->url, $body);
        $response->assertStatus(302);
        $response->assertRedirect('/homepage/new_employee');
        
        $emploee = User::orderBy('id', 'desc')->first();
        $this->assertEquals($emploee->email, $body['email']);
    }
}
