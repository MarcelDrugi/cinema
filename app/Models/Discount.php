<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    
    public function save(array $options = array())
    {
        if ($this->isValid())
        {
            parent::save($options);
        } 
        else 
        {
            throw new \Exception("Wrong discount code. Exactly 16 characters are required.", 1);
        }
    }
    
    public function isValid()
    {
        $values = $this->getAttributes();
        $rules = ['code' => 'string|between:16,16'];
        
        $v = \Validator::make($values, $rules);
        
        $isValid = !$v->fails();
        $this->errors = $isValid ? new \Illuminate\Support\MessageBag() : $v->messages();
        
        return $isValid;
    }
}
