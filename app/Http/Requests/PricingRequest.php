<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Screening;
use App\Services\PricingService;

class PricingRequest extends FormRequest
{
    public function rules()
    {
        $rules = [];
        $ticketTypes = ['normal', 'school', 'senior'];
        
        foreach (PricingService::$weekDays as $day) {
            foreach ($ticketTypes as $type) {
                
                $rules[$day . $type] = [
                    
                    function($attribute, $value, $fail)
                    {
                        if (!empty($value) && !filter_var($value, FILTER_VALIDATE_INT))
                            $fail(__('The ticket price must be an INTEGER'));
                    },
                    
                    function($attribute, $value, $fail) use ($day){
                        if (
                            !empty($this->input($day . 'normal')) &&
                            !empty($this->input($day . 'school')) &&
                            !empty($this->input($day . 'senior'))
                            ) 
                        { } elseif(
                            empty($this->input($day . 'normal')) &&
                            empty($this->input($day . 'school')) &&
                            empty($this->input($day . 'senior'))
                            ) 
                        { } else {
                            $fail(__('You must specify the prices of all ticket types to create a price list, ' .
                                    'or delete all prices to delete them. You cannot create a partial price list.'
                            ));
                        }
                    },
                    
                ];
                
            }
        }
        
        return $rules;
    }
    
    public function authorize()
    {
        return true;
    }
}
