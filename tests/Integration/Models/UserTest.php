<?php


namespace Tests\Integration;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Discount;


class UserTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function relationWithReservation()
    {
        $reservation = Reservation::factory()->create();
        $user = User::orderBy('id', 'desc')->first();
        
        $this->assertEquals($reservation->id, $user->reservation->id);
    }
    
    /** @test */
    public function relationWithDiscount()
    {
        $discount = Discount::factory()->create();
        $user = User::orderBy('id', 'desc')->first();
        
        $this->assertEquals($discount->id, $user->discounts[0]->id);
    }
}