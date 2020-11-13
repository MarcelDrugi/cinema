<?php

namespace App\Services;

use App\Models\Reservation;

class ConfirmReservationService
{
    private $reservationId, $parameters;
    
    public function __construct(string $reservationId, array $parameters)
    {
        $this->reservationId = $reservationId;
        $this->parameters = $parameters;
    }
    
    public function confirm()
    {
        $reservation = Reservation::find($this->reservationId);
        $reservation->payment_status = true;
        $reservation->payment_id = $this->parameters['paymentId'];
        $reservation->payer_id = $this->parameters['payerId'];
        $reservation->save();
    }
}