<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Exception;

class Information extends Model
{
    use HasFactory;
    
    private $errors;
    
    protected $fillable = [
        'place',
        'content',
        'max_length',
    ];
    
    static $availablePlaces = [
        'homepage_slider',
        'homepage_top',
        'homepage_bottom',
        'repertoire',
        'pricing',
        'about_side',
        'about_bottom',
        'api',
    ];
    
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
            'content' => function($attribute, $value, $fail) {
                if(strlen($value) > $this->max_length)
                $fail('Content is too long.');
            },
        ];
        
        $v = Validator::make($values, $rules);
        
        $isValid = !$v->fails();
        $this->errors = $isValid ? new \Illuminate\Support\MessageBag() : $v->messages();
        
        return $isValid;
    }
}
