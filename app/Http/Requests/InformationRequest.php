<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Information;

class InformationRequest extends FormRequest
{
    public function rules()
    {
        return [
            'infoSelect' => [
                'bail',
                'required',
                function($attribute, $value, $fail) {
                    $place = json_decode($value, true)['place'];
                    
                    if(!in_array($place, Information::$availablePlaces))
                        $fail(__('Unknown info location.'));
                },
            ],
            
            'content' => [
                'bail',
                function($attribute, $value, $fail) {
                    $place = json_decode($this->infoSelect, true)['place'];
                    
                    if($info = Information::where('place', $place)->first()) {
                        if(strlen($value) > $info->max_length) {
                            $fail(__('Content is too long.'));
                        }
                    }
                }
            ],
        ];   
    }
}

