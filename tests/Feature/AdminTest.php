<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class AdminTest extends NoPermissionRedirect
{
    use RefreshDatabase;
    
    protected $url = '/admin';
    protected $correctRole = 'admin';
    protected $incorrectRole = 'employee';
    
    /** @test */
    public function getRedirectNotLoggedInUser()
    {
        parent::getRedirectNotLoggedInUser();
    }
    
    /** @test */
    public function postRedirectNotLoggedInUser()
    {
        parent::postRedirectNotLoggedInUser();
    }
    
    public function getRedirectUserWithoutPermission()
    {        
        parent::getRedirectUserWithoutPermission();
    }
    
    /** @test */
    public function postRedirectUserWithoutPermission()
    {
        parent::postRedirectUserWithoutPermission();
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
