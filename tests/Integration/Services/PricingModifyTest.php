<?php

namespace Tests\Integration;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use RuntimeException;
use App\Models\Pricing;
use App\Services\PricingService;


class PricingModifyTest extends TestCase
{
    use RefreshDatabase;
    
    public function setUp(): void {
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
    public function editPricing()
    {    
        $pricing = Pricing::factory()->create();
        
        $newNormalPrice = 25;
        $newSchoolPrice = 18;
        $newSeniorPrice = 20;
        
        $data = [];
        
        foreach($this->weekDays as $day) {
            foreach($this->ticketTypes as $ticket) {
                $data[$day . $ticket] = '';
            }
        }
        
        $data[$pricing->week_day . 'normal'] = $newNormalPrice;
        $data[$pricing->week_day . 'school'] = $newSchoolPrice;
        $data[$pricing->week_day . 'senior'] = $newSeniorPrice;
        
        $service = new PricingService($data);
        $service->updatePricing();
        
        $updatedPricing = Pricing::find($pricing->id);
        
        $this->assertEquals($updatedPricing->normal, $newNormalPrice);
        $this->assertEquals($updatedPricing->school, $newSchoolPrice);
        $this->assertEquals($updatedPricing->senior, $newSeniorPrice);
    }
    
    /** @test */
    public function newPricing()
    {
        $data = [];
        $price = 13;
        
        foreach($this->weekDays as $day) {
            foreach($this->ticketTypes as $ticket) {
                $data[$day . $ticket] = $price;
            }
        }
        
        $service = new PricingService($data);
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Session store not set on request.');  // There is no request in service's test
        $service->updatePricing();
        
        $pricings = Pricing::all();
        
        $this->assertEquals($pricings->count(), count($this->weekDays));
        
        foreach($pricings as $pricing) {
            $this->assertEquals($pricing->normal, $price);
            $this->assertEquals($pricing->school, $price);
            $this->assertEquals($pricing->senior, $price);
        }
    }
    
    /** @test */
    public function removePricing()
    {
        $pricing = Pricing::factory()->create();
        $data = [];
        
        foreach($this->weekDays as $day) {
            foreach($this->ticketTypes as $ticket) {
                $data[$day . $ticket] = '';
            }
        }
        
        $service = new PricingService($data);
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Session store not set on request.');  // There is no request in service's test
        $service->updatePricing();
        
        $pricings = Pricing::all();
        
        $this->assertEquals($pricings->count(), 0);
        $this->assertNull(Pricing::find($pricing->id));
    }
}
