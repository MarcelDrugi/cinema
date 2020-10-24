<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Screening extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'movie_id',
        'viewers'
    ];
    
    public function movie()
    {
        return $this->belongsTo('App\Models\Movie');
    }
    
    public function term()
    {
        return $this->hasOne('App\Models\Term');
    }
    
    public function reservations()
    {
        return $this->hasMany('App\Models\Reservation');
    }
    
    public static function boot()
    {
        parent::boot();
        
        self::saving(function($model){
            if($model->term)
            {
                if($model->viewers > $model->term->hall->capacity)
                {
                    throw new \Exception('The number of viewers is greater than the capacity of the hall!', 1);
                }
            }
        });
    }
}
