<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;


class Discount extends Model
{
    use HasFactory;
    
    private $errors;
    
    protected $fillable = [
        'user_id',
        'code',
        'value',
    ];
    
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    
    public function randomCode()
    {
        while(true) {
            $code = Str::random(16);
            $discount = Discount::where('code', $code)->first();
            if(!$discount) {
                $this->code = $code;
                $this->save();
                break;
            }    
        }  
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
        $rules = [
            'code' => 'string|between:16,16',
            'value' => 'numeric|min:0.01|max:0.99',
        ];
        
        $v = Validator::make($values, $rules);
        
        $isValid = !$v->fails();
        $this->errors = $isValid ? new \Illuminate\Support\MessageBag() : $v->messages();
        
        return $isValid;
    }
}
