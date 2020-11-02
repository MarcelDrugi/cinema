<?php 

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Factory;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function rules()
    {
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($this->profile)],
            'password' => ['string', 'min:8', 'confirmed', 'nullable'],
            'avatar' => ['file', 'mimes:jpeg,jpg,bmp,png,gif', 'max:3000'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}