<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SummaryTest extends NoPermissionRedirect
{
    use RefreshDatabase;
    
    protected $url = '/summary';
    protected $incorrectRole = 'employee';
    protected $correctRole = 'customer';
    
    /** @test */
    public function getRedirectNotLoggedInUser()
    {
        parent::getRedirectNotLoggedInUser();
    }
    
    /** @test */
    public function getRedirectUserWithoutPermission()
    {
        parent::getRedirectUserWithoutPermission();
    }
    
    /**
     * The GET request should be rejected if it has wrong refferer,
     * even if the user is logged in and has permissions.
     *
     * @test
     */
    public function getRejectIfWrongReferrer()
    {
        $user = User::factory()->make();
        $user->assignRole('customer');
        $user->save();
        
        $response = $this->actingAs($user)->get($this->url);
        $response->assertStatus(400);
    }
    
    /**
     * The GET request should be return response with status: 200,
     * and modify the session.
     *
     * @test
     */
    public function correctGetRequest()
    {
        $user = User::factory()->make();
        $user->assignRole('customer');
        $user->save();
        
        $session = [
            'toPay' => 10.00,
            'discountId' => 'noDiscount',
            'summOfTickets' => '4',
            'normalTickets' => '2',
            'juniorTickets' => '1',
            'seniorTickets' => '1',
        ];
        
        $response = $this
            ->actingAs($user)
            ->withSession($session)
            ->call('GET', $this->url, [], [], [],  ['HTTP_REFERER' => env('APP_URL') . '/order']);
        $response->assertStatus(200);
        
        $response->assertSessionHas('toPay');
        $response->assertSessionHas('summOfTickets');
        $response->assertSessionHas('discountId');
        
        $response->assertSessionMissing('normalTickets');
        $response->assertSessionMissing('juniorTickets');
        $response->assertSessionMissing('seniorTickets');
    }
}
