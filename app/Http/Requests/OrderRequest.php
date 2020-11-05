<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Screening;

class OrderRequest extends FormRequest
{
    public function rules()
    {   
        return [
            'discountRadio' => ['required'],
            'normalTickets' => [
                'required',
                function($attribute, $value, $fail) {
                    if($value < 0) {
                        $fail($attribute .' must be positive');
                    }
                    else {
                        $id = $this->input('screeningId');
                        $screening = Screening::findOrFail($id);
                        $freeTickets = $screening->term->hall->capacity - $screening->viewers;
                        if($value + $this->input('juniorTickets') + $this->input('seniorTickets') > $freeTickets) {
                            $fail('Too many tickets');
                        }
                    }
                },
            ],
            'juniorTickets' => ['required'],
            'seniorTickets' => ['required'],
        ];
    }
    
    public function authorize()
    {
        return true;
    }
}
