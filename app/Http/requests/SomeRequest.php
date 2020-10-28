<?php 

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
//use Response;

class SomeRequest extends FormRequest
{
    public function rules()
    {
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }

    public function authorize()
    {
        return false;
    }
}