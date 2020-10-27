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
        'time',
        'age_limit',
        'new',
    ];
    
    public function screenings()
    {
        return $this->hasMany('App\Models\Screening');
    }
}
