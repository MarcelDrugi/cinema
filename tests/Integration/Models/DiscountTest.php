<?php


namespace Tests\Integration;

use Tests\TestCase;
use App\Models\Discount;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DiscountTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function relationWithUser()
    {
        $discount = Discount::factory()->create();
        $this->assertEquals($discount->user_id, $discount->user->id);
    }
    
    /** @test */
    public function customCodeValidation()
    {
        $discount = Discount::factory()->create();
        $this->assertEquals(16, strlen($discount->code));
    }
}