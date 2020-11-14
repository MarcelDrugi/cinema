<?php 

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateMovieRequest extends FormRequest
{
    public function rules()
    {
        return [
            'newTitle' => ['required', 'string', 'max:255'],
            'newDescription' => ['required', 'string'],
            'newPublished' => ['required', 'numeric'],
            'newTime' => ['required', 'numeric'],
            'newAge_limit' => ['required', 'numeric', 'max:18'],
            'newPoster' => ['file', 'mimes:jpeg,jpg,bmp,png,gif', 'max:3000'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
