<?php

namespace App\Services;

use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use App\Models\Discount;
use App\Models\Screening;
use Exception;

final class ReservationService
{
    private $screeningId, $discountId, $toPay, $sumOfTickets;
    
    public function __construct($screeningId, $toPay, $sumOfTickets, $discountId)
    {
        $this->screeningId = $screeningId; 
        $this->toPay = $toPay;
        $this->sumOfTickets = $sumOfTickets;
        $this->discountId = $discountId;
    }
    
    public function createReservation()
    {
        if($this->addNewViewers())
        {
            $reservation = Reservation::create([
                'screening_id' => $this->screeningId,
                'user_id' => Auth::user()->id,
                'payment_status' => false,
                'price' => $this->toPay,
                'tickets_number' => $this->sumOfTickets,
            ]);
            session()->put('reservationId', $reservation->id);
        } 
        else
            throw new Exception('There are no free seats in the hall!');
    }
    
    public function removeDiscount()
    {
        if($this->discountId !== 'noDiscount')
        {
            $discount = Discount::findOrFail($this->discountId);
            $discount->delete();
        }
    }
    
    private function addNewViewers()
    {
        $screening = Screening::findOrFail($this->screeningId);
        if($screening->viewers + $this->sumOfTickets <= $screening->term->hall->capacity) {
            $screening->viewers += $this->sumOfTickets;
            $screening->save();
            return true;
        }
        else
            return false;
    }
}