<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pricing extends Model
{
    use HasFactory;
    
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
}
