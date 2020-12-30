<?php

namespace App\Services;

use Illuminate\Support\Facades\Hash;
use App\Models\Discount;

final class DiscountService
{
    private $data;
    
    public function __construct($data)
    {
        $this->data = $data;
    }
    
    public function createDiscount()
    {
        $discount = new Discount([
            'value' => $this->data['value'] / 100,
        ]);
        $discount->randomCode();

        if (!empty($this->data['customerSelect'])) {
            $discount->user_id = $this->data['customerSelect'];
            $discount->save();
        }
        
        $request = request();
        $request->session()->flash('newDiscount', $discount->id);
    }
    
    public function delDiscount()
    {
        if (!empty($this->data['selectDiscount'])) {
            $id = json_decode($this->data['selectDiscount'], true)['id'];
            $discount = Discount::findOrFail($id);
            
            $request = request();
            $request->session()->flash('deletedDiscount', $discount->code);
            
            $discount->delete();
        } else
            abort(404, 'Discount does not exist.');
    }
}
