<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Screening;

class RemoveDiscountRequest extends FormRequest
{
    public function rules()
    {   
        return [
            'selectDiscount' => [
                'required',
                function($attribute, $value, $fail)
                {
                    $id = json_decode($value, true)['id'];
                    
                    if (!filter_var($id, FILTER_VALIDATE_INT))
                        $fail(__('id must be an INTEGER'));
                },
            ],
        ];
    }
    
    public function authorize()
    {
        return true;
    }
}
