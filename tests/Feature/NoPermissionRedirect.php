<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Base class for all test classes that check basic redirects.
 *
 */
class NoPermissionRedirect extends TestCase
{
    use RefreshDatabase;
    
    protected $url = '';
    protected $correctRole = '';
    protected $incorrectRole = '';
    
    public function getRedirectNotLoggedInUser()
    {
        $response = $this->get($this->url);
        $response->assertStatus(302);
        $response->assertRedirect('/login');
        
        $this->followingRedirects()
            ->get($this->url)
            ->assertStatus(200);
    }
    
    public function postRedirectNotLoggedInUser()
    {
        $response = $this->post($this->url);
        $response->assertStatus(302);
        $response->assertRedirect('/login');
        
        $this->followingRedirects()
            ->post($this->url)
            ->assertStatus(200);
    }
    
    public function putRedirectNotLoggedInUser()
    {
        $response = $this->put($this->url);
        $response->assertStatus(302);
        $response->assertRedirect('/login');
        
        $this->followingRedirects()
            ->put($this->url)
            ->assertStatus(200);
    }
    
    public function deleteRedirectNotLoggedInUser()
    {
        $response = $this->delete($this->url);
        $response->assertStatus(302);
        $response->assertRedirect('/login');
        
        $this->followingRedirects()
            ->delete($this->url)
            ->assertStatus(200);
    }
    
    public function getRedirectUserWithoutPermission()
    {        
        $user = User::factory()->make();
        $user->assignRole($this->incorrectRole);  // Role is created by afterMaking() in 'UserFactory'.
        $user->save();
        
        $response = $this->actingAs($user)->get($this->url);
        $response->assertStatus(302);
        $response->assertRedirect('/noperm/' . $this->correctRole);
        
        $this->followingRedirects()
            ->get($this->url)
            ->assertStatus(200);
    }
    
    public function postRedirectUserWithoutPermission()
    {
        $user = User::factory()->make();
        $user->assignRole($this->incorrectRole);  // Role is created by afterMaking() in 'UserFactory'.
        $user->save();
        
        $response = $this->actingAs($user)->post($this->url);
        $response->assertStatus(302);
        $response->assertRedirect('/noperm/' . $this->correctRole);
        
        $this->followingRedirects()
            ->post($this->url)
            ->assertStatus(200);
    }
    
    public function putRedirectUserWithoutPermission()
    {
        $user = User::factory()->make();
        $user->assignRole('customer');  // Role is created by afterMaking() in 'UserFactory'.
        $user->save();
        
        $response = $this->actingAs($user)->put($this->url);
        $response->assertStatus(302);
        $response->assertRedirect('/noperm/employee');
        
        $this->followingRedirects()
        ->put($this->url)
        ->assertStatus(200);
    }
    
    public function deleteRedirectUserWithoutPermission()
    {
        $user = User::factory()->make();
        $user->assignRole('customer');  // Role is created by afterMaking() in 'UserFactory'.
        $user->save();
        
        $response = $this->actingAs($user)->delete($this->url);
        $response->assertStatus(302);
        $response->assertRedirect('/noperm/employee');
        
        $this->followingRedirects()
            ->delete($this->url)
            ->assertStatus(200);
    }
}

