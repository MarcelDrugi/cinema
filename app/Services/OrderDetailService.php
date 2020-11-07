<?php

namespace App\Services;


use Illuminate\Http\Request;
use App\Models\Discount;

class OrderDetailService
{
    public function orderContext()
    {
        $request = request();
        
        session()->keep('screeningId');
        
        $toPay = $request->session()->get('toPay');
        session()->keep('toPay');
        
        $summOfTickets = $request->session()->get('summOfTickets');
        session()->keep('sumOfTickets');
        
        $discountId = $request->session()->get('discountId');
        session()->keep('discountId');
        $discount = Discount::find($discountId);
        
        $normalTickets = $request->session()->get('normalTickets');
        session()->forget('normalTickets');
        
        $juniorTickets = $request->session()->get('juniorTickets');
        session()->forget('juniorTickets');
        
        $seniorTickets = $request->session()->get('seniorTickets');
        session()->forget('seniorTickets');
        
        return [
            'toPay' => $toPay,
            'discount' => $discount,
            'summOfTickets' => $summOfTickets,
            'normalTickets' => $normalTickets,
            'juniorTickets' => $juniorTickets,
            'seniorTickets' => $seniorTickets,
        ];
    }
}