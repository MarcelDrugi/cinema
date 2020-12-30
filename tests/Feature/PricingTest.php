<?php


namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Pricing;

class PricingTest extends NoPermissionRedirect
{
    use RefreshDatabase;
    
    protected $url = '/modify-pricing';
    protected $correctRole = 'employee';
    protected $incorrectRole = 'customer';
    
    public function setUp(): void 
    {
        parent::setUp();
        
        $this->weekDays = [
            'Monday',
            'Tuesday',
            'Wednesday',
            'Thursday',
            'Friday',
            'Saturday',
            'Sunday',
        ];
        
        $this->ticketTypes = ['normal', 'school', 'senior'];
    }
    
    /** @test */
    public function getRedirectNotLoggedInUser()
    {
        parent::getRedirectNotLoggedInUser();
    }
    
    /** @test */
    public function putRedirectNotLoggedInUser()
    {
        parent::postRedirectNotLoggedInUser();
    }
    
    /** @test */
    public function getRedirectUserWithoutPermission()
    {
        parent::getRedirectUserWithoutPermission();
    }
    
    /** @test */
    public function putRedirectUserWithoutPermission()
    {
        parent::postRedirectUserWithoutPermission();
    }
    
    /** @test */
    public function createPricing()
    {

        $user = User::factory()->make();
        $user->assignRole('employee');
        $user->save();
        
        $body = [];
        $ticketCost = 10;
        
        foreach ($this->weekDays as $day) {
            foreach ($this->ticketTypes as $ticket) {
                $body[$day . $ticket] = $ticketCost;
            }
        }
        
        $response = $this->actingAs($user)->put($this->url, $body);
        $response->assertStatus(302);
        $response->assertRedirect($this->url);
        $response->assertSessionHas('pricingCreated', true);
        
        $pricings = Pricing::all();
        
        $this->assertEquals($pricings->count(), count($this->weekDays));
        
        foreach($pricings as $pricing) {
            $this->assertEquals($pricing->normal, $ticketCost);
            $this->assertEquals($pricing->school, $ticketCost);
            $this->assertEquals($pricing->senior, $ticketCost);
        }
    }
    
    /** @test */
    public function deletePricing()
    {
        
        $user = User::factory()->make();
        $user->assignRole('employee');
        $user->save();
        
        $pricing = Pricing::factory()->create();
        $body = [];
        
        foreach ($this->weekDays as $day) {
            foreach ($this->ticketTypes as $ticket) {
                $body[$day . $ticket] = '';
            }
        }
        
        $response = $this->actingAs($user)->put($this->url, $body);
        $response->assertStatus(302);
        $response->assertRedirect($this->url);
        $response->assertSessionHas('pricingDeleted', true);
        
        $pricings = Pricing::all();
        
        $this->assertEquals($pricings->count(), 0);
        $this->assertNull(Pricing::find($pricing->id));
    }
    
    /** @test */
    public function modifyPricing()
    {
        
        $user = User::factory()->make();
        $user->assignRole('employee');
        $user->save();
        
        $pricing = Pricing::factory()->create();
        
        $newNormalPrice = 25;
        $newSchoolPrice = 18;
        $newSeniorPrice = 20;
        
        $body = [];
        
        foreach ($this->weekDays as $day) {
            foreach ($this->ticketTypes as $ticket) {
                $body[$day . $ticket] = '';
            }
        }
        
        $body[$pricing->week_day . 'normal'] = $newNormalPrice;
        $body[$pricing->week_day . 'school'] = $newSchoolPrice;
        $body[$pricing->week_day . 'senior'] = $newSeniorPrice;
        
        $response = $this->actingAs($user)->put($this->url, $body);
        $response->assertStatus(302);
        $response->assertRedirect($this->url);
        
        $updatedPricing = Pricing::find($pricing->id);
        
        $this->assertEquals($updatedPricing->normal, $newNormalPrice);
        $this->assertEquals($updatedPricing->school, $newSchoolPrice);
        $this->assertEquals($updatedPricing->senior, $newSeniorPrice);
    }   
}
