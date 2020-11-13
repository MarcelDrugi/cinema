<?php


namespace Tests\Integration;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Reservation;

class ReservTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function relationWithUser()
    {
        $reservation = Reservation::factory()->create();
        $this->assertEquals($reservation->user_id, $reservation->user->id);
    }
    
    /** @test */
    public function relationWithScreening()
    {
        $reservation = Reservation::factory()->create();
        $this->assertEquals($reservation->screening_id, $reservation->screening->id);
    }
}