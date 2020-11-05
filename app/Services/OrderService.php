<?php

namespace App\Services;

use App\Models\Screening;

class OrderService
{
    private $data;
    
    public function __construct(array $data)
    {
        $this->data = $data;
    }
    
    public function toPay()
    {
        $request = request();
        
        $screening = Screening::findOrFail($this->data['screeningId']);
        $pricing = $screening->term->pricing;
        
        $toPay = $this->data['normalTickets'] * $pricing->normal + $this->data['juniorTickets'] * $pricing->school +
        $this->data['seniorTickets'] * $pricing->senior;
        $toPay *= (1.0 - $this->data['discountRadio']);
        
        $request->session()->put('toPay', $toPay);
        $request->session()->put('discountId', $this->data['discountId']);
        $request->session()->put(
            'summOfTickets',
            $this->data['normalTickets'] + $this->data['juniorTickets'] + $this->data['seniorTickets']
        );
        
        if($toPay > 0)
            return $toPay;
        else
            abort(404);
    }
    
}