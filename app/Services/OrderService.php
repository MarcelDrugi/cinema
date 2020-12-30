<?php

namespace App\Services;

use App\Models\Screening;

final class OrderService
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
        
        $request->session()->flash('toPay', $toPay);
        $request->session()->flash('screeningId', $this->data['screeningId']);
        $request->session()->flash('discountId', $this->data['discountId']);
        $request->session()->flash('normalTickets', $this->data['normalTickets']);
        $request->session()->flash('juniorTickets', $this->data['juniorTickets']);
        $request->session()->flash('seniorTickets', $this->data['seniorTickets']);
        $request->session()->flash(
            'sumOfTickets',
            $this->data['normalTickets'] + $this->data['juniorTickets'] + $this->data['seniorTickets']
        );
        
        if ($toPay > 0)
            return $toPay;
        else
            abort(404);
    }
    
}