<?php

namespace Tests\Feature;

use App\Models\Pricing;
use App\Models\Screening;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;
use App\Models\Term;
use Carbon\Traits\Date;
use Carbon\Carbon;

class OrderTest extends TestCase
{
    use RefreshDatabase;
    
    protected $url = '/order';

    /** @test */
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
     * Create user with correct role and records necessary to request.
     * 
     */
    protected function createBasicData()
    {
        $user = User::factory()->make();
        $user->assignRole('customer');
        $user->save();
        
        $screening = Screening::factory()->create();
        
        Term::factory()->for(Pricing::factory()->state(['week_day' => 'Monday']))->create([
            'screening_id' => $screening->id,
            'date_time' => new Carbon('2020-12-21 20:00:00')
        ]);
        
        $body = [
            'discountRadio' => '0',
            'discountId' => 'noDiscount',
            'normalTickets' => '2',
            'juniorTickets' => '0',
            'seniorTickets' => '1',
            'screeningId' => $screening->id,
        ];
        
        return ['user' => $user, 'body' => $body];
    }
    
    /**
     * The POST request should be rejected if it has wrong refferer,
     * even if the user is logged in and has permissions.
     * 
     * @test
     */
    public function postRejectIfWrongReferrer()
    {
        $data = $this->createBasicData();
        
        $response = $this
            ->actingAs($data['user'])
            ->call('POST', $this->url, $data['body']);
        $response->assertStatus(400);
    }
    
    /**
     * The POST request should be redirected back to '/order' if referrer is correct,
     * but data in body is incorrect.
     *
     * @test
     */
    public function postAcceptedIfCorrectReferrer()
    {
        $user = User::factory()->make();
        $user->assignRole('customer');
        $user->save();
        
        $response = $this
            ->actingAs($user)
            ->call('POST', $this->url, ['something' => 'bad'], [], [],  ['HTTP_REFERER' => env('APP_URL') . '/order']);
        $response->assertStatus(302);
        $response->assertRedirect('/order');
        
        $this->followingRedirects()
            ->post($this->url)
            ->assertStatus(200);
    }
    
    /**
     * The POST request should be redirected to '/summary' if referrer is correct,
     * and data in body is incorrect.
     * The session should also be modified accordingly.
     *
     * @test
     */
    public function postRedirectToSummary()
    {
        $data = $this->createBasicData();

        $response = $this
            ->actingAs($data['user'])
            ->call('POST', $this->url, $data['body'], [], [],  ['HTTP_REFERER' => env('APP_URL') . '/order']);
        $response->assertStatus(302);
        $response->assertRedirect('/summary');
        
        $response->assertSessionHas('toPay');
        $response->assertSessionHas('screeningId');
        $response->assertSessionHas('discountId');
        $response->assertSessionHas('normalTickets');
        $response->assertSessionHas('juniorTickets');
        $response->assertSessionHas('seniorTickets');
        $response->assertSessionHas('sumOfTickets');
            
        $this->followingRedirects()
            ->post($this->url)
            ->assertStatus(200);
    }
    
    /** @test */
    public function getRedirectNotLoggedInUser()
    {
        $id = 22;
        
        $response = $this->get($this->url . "/$id");
        $response->assertStatus(302);
        $response->assertRedirect('/login');
        
        $this->followingRedirects()
            ->get($this->url . "/$id")
            ->assertStatus(200);
    }
    
    /** @test */
    public function getRedirectUserWithoutPermission()
    {
        $id = 5;
        
        $user = User::factory()->make();
        $user->assignRole('employee');  // Role is created by afterMaking() in 'UserFactory'.
        $user->save();
        
        $response = $this->actingAs($user)->get($this->url . "/$id");
        $response->assertStatus(302);
        $response->assertRedirect('/noperm/customer');
        
        $this->followingRedirects()
            ->get($this->url . "/$id")
            ->assertStatus(200);
    }
    
    /** @test */
    public function getRequestWithPermission()
    {
        $user = User::factory()->make();
        $user->assignRole('customer');  // Role is created by afterMaking() in 'UserFactory'.
        $user->save();
        
        $screening = Screening::factory()->create();
        
        Term::factory()->for(Pricing::factory()->state(['week_day' => 'Monday']))->create([
            'screening_id' => $screening->id,
            'date_time' => new Carbon('2020-12-21 20:00:00'),
        ]);
        
        $response = $this->actingAs($user)->get($this->url . "/$screening->id");
        $response->assertStatus(200);

    }
}
