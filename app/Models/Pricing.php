<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Exception;

class Pricing extends Model
{
    use HasFactory;
    
    private $errors;
    
    protected $fillable = [
        'week_day',
        'normal',
        'school',
        'senior'
    ];
    
    public function terms()
    {
        return $this->hasMany('App\Models\Term');
    }
    
    public function save(array $options = array())
    {
        if ($this->isValid())
        {
            parent::save($options);
        }
        else
        {
            $fail = $this->errors->first();
            throw new Exception($fail, 0);
        }
    }
    
    public function isValid()
    {
        $values = $this->getAttributes();
        
        $weekDays = [
            'Sunday',
            'Monday',
            'Tuesday',
            'Wednesday',
            'Thursday',
            'Friday',
            'Saturday',
        ];
        
        $rules = [
            'week_day' => function($attribute, $value, $fail) use ($weekDays) {
                if(!in_array($value, $weekDays)) {
                    $fail('The value must be one of the days of the week in English.');
                }
            },
        ];
        
        $v = Validator::make($values, $rules);
        
        $isValid = !$v->fails();
        $this->errors = $isValid ? new \Illuminate\Support\MessageBag() : $v->messages();
        
        return $isValid;
    }
}
