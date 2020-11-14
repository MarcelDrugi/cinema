<?php 

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditMovieRequest extends FormRequest
{
    public function rules()
    {
        return [      
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'published' => ['required', 'numeric'],
            'time' => ['required', 'numeric'],
            'age_limit' => ['required', 'numeric', 'max:18'],
            'poster' => ['file', 'mimes:jpeg,jpg,bmp,png,gif', 'max:3000'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
