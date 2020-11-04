<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'description',
        'published',
        'time',
        'age_limit',
        'new_movie',
    ];
    
    public function screenings()
    {
        return $this->hasMany('App\Models\Screening');
    }
    
    public function sevenDaysScreenings()
    {
        return $this->hasMany('App\Models\Screening')->has('sevenDaysTerm');
    }
}
