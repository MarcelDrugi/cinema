<?php

namespace Tests\Integration;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Reservation;
use App\Services\ConfirmReservationService;

class ConfirmReservationTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function confirm()
    {
        $reservation = Reservation::factory()->create();
        $parameters = [
            'paymentId' => 'abcdefghijk123456789',
            'payerId' => 'xyz000000',
        ];
        
        $service = new ConfirmReservationService($reservation->id, $parameters);
        $service->confirm();
        
        $reservation = Reservation::find($reservation->id);  // take the same reservation after modification in service
        
        $this->assertEquals($reservation->payment_status, true);
        $this->assertEquals($reservation->payment_id, $parameters['paymentId']);
        $this->assertEquals($reservation->payer_id, $parameters['payerId']);
    }
}
