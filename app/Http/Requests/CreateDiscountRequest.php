<?php 

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateDiscountRequest extends FormRequest
{
    public function rules()
    {
        return [
            'value' => ['required', 'numeric', 'min:1', 'max:99'],
            'customerSelect' => ['numeric', 'min:1']
        ];
    }

    public function authorize()
    {
        return true;
    }
}