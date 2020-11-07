<?php

namespace App\Http\Controllers;

use App\Services\PayPalService;
use App\Services\ReservationService;
use Illuminate\Support\Facades\DB;
use App\Models\Reservation;

class ReservationController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('role:customer');
    }
    
    public function store(PayPalService $paypal)
    {
        $referer = request()->server('HTTP_REFERER');
        if (!strpos($referer,'/summary'))
            dd("NOT ALLOWED");
        
        $reservationService = new ReservationService(
            session()->get('screeningId'),
            session()->get('toPay'),
            session()->get('sumOfTickets'),
            session()->get('discountId')
        );
       
        DB::transaction(function () use ($reservationService) {
            $reservationService->createReservation();
            $reservationService->removeDiscount();
        });
        
        if($redirect_url = $paypal->createPayment(request()->input('toPay')))
            return redirect($redirect_url);
        else
            return redirect()->route('homepage.index', ['action' => 'nonpaid']);
       
        //return session()->get('sumOfTickets');
        
    }
}
