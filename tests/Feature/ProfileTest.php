<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Models\Reservation;

class ProfileTest extends TestCase
{
    use RefreshDatabase;
    
    protected $url = '/profile';
    
    /** $test */
    public function postRedirectNotLoggedInUser()
    {
        $response = $this->post($this->url);
        $response->assertStatus(302);
        $response->assertRedirect('/login');
        
        $this->followingRedirects()
            ->post($this->url)
            ->assertStatus(200);
    }
    
    /** @test */
    public function postRedirectUserWithoutPermission()
    {
        $user = User::factory()->make();
        $user->assignRole('employee');  // Role is created by afterMaking() in 'UserFactory'.
        $user->save();
        
        $response = $this->actingAs($user)->post($this->url);
        $response->assertStatus(302);
        $response->assertRedirect('/noperm/customer');
        
        $this->followingRedirects()
        ->post($this->url)
        ->assertStatus(200);
    }
    
    /**
     * The POST request should be rejected if body hasn't got 'reservationId'.
     *
     * @test
     */
    public function postWithIncorrectBody()
    {
        $user = User::factory()->make();
        $user->assignRole('customer');
        $user->save();
        
        $response = $this->actingAs($user)->post($this->url);
        $response->assertStatus(404);
    }
    
    /**
     * The POST request should be redirected if user has permission and 
     * data in request body is OK.
     * The session should also be modified accordingly.
     *
     * @test
     */
    public function postRedirect()
    {
        $user = User::factory()->make();
        $user->assignRole('customer');
        $user->save();
        
        $reservation = Reservation::factory()->create(['user_id' => $user->id]);
        
        $body = ['reservationId' => $reservation->id];
        $session = ['toPay' => $reservation->price];
        
        $response = $this->actingAs($user)->withSession($session)->post($this->url, $body);
        $response->assertStatus(302);
        
        $response->assertSessionHas('reservationId', $body['reservationId']);
    }
    
    /** $test */
    public function getRedirectNotLoggedInUser()
    {
        $response = $this->get($this->url . '/info');
        $response->assertStatus(302);
        $response->assertRedirect('/login');
        
        $this->followingRedirects()
            ->get($this->url . '/info')
            ->assertStatus(200);
    }
    
    /** @test */
    public function getRedirectUserWithoutPermission()
    {
        $user = User::factory()->make();
        $user->assignRole('employee');
        $user->save();
        
        $response = $this->actingAs($user)->get($this->url . '/info');
        $response->assertStatus(302);
        $response->assertRedirect('/noperm/customer');
        
        $this->followingRedirects()
            ->get($this->url . '/info')
            ->assertStatus(200);
    }
    
    /**
     * The GET request should be return response with status: 200.
     *
     * @test
     */
    public function correctGetRequest()
    {
        $user = User::factory()->make();
        $user->assignRole('customer');
        $user->save();
        
        $response = $this
            ->actingAs($user)
            ->get($this->url . '/info');
        $response->assertStatus(200);
    }
    
    /** $test */
    public function putRedirectNotLoggedInUser()
    {
        $id = 9413;
        
        $response = $this->put($this->url . "/$id");
        $response->assertStatus(302);
        $response->assertRedirect('/login');
        
        $this->followingRedirects()
            ->put($this->url . "/$id")
            ->assertStatus(200);
    }
    
    /** @test */
    public function putRedirectUserWithoutPermission()
    {
        $user = User::factory()->make();
        $user->assignRole('employee');
        $user->save();
        
        $response = $this->actingAs($user)->put($this->url . "/$user->id");
        $response->assertStatus(302);
        $response->assertRedirect('/noperm/customer');
        
        $this->followingRedirects()
            ->put($this->url . "/$user->id")
            ->assertStatus(200);
    }
    
    /** 
     * 
     * The PUT request should be redirected  to '/profile/info/newData' if user has permission and 
     * data in request body is OK.
     * 
     * @test 
     * */
    public function putRedirect()
    {
        $user = User::factory()->make();
        $user->assignRole('customer');
        $user->save();

        $body = [
            'first_name' => 'newName',
            'last_name' => $user->last_name,
            'email' => $user->email,
            'password' => 'someNewPassword',
            'password_confirmation' => 'someNewPassword',
            '_method' => 'PUT',
        ];

        $response = $this->actingAs($user)->post($this->url . "/$user->id", $body);
        $response->assertStatus(302);
        $response->assertRedirect('/profile/info/newData');
        
        $this->followingRedirects()
            ->post($this->url . "/$user->id", $body)
            ->assertStatus(200);
    }
}
