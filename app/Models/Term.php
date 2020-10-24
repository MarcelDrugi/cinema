<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'screening_id',
        'hall_id',
        'pricing_id',
        'date_time',
    ];
    
    public function screening()
    {
        return $this->hasOne('App\Models\Screening');
    }
    
    public function hall()
    {
        return $this->belongsTo('App\Models\Hall');
    }
    
    public function pricing()
    {
        return $this->belongsTo('App\Models\Pricing');
    }
    
    public static function boot()
    {
        parent::boot();
        
        self::creating(function($model){
            $date = $model->date_time;
            $unixTimestamp = strtotime($date);
            $dayOfWeek = date("l", $unixTimestamp);
            
            $pricing = Pricing::where('week_day', $dayOfWeek)->first();
            $model->pricing()->associate($pricing);
        });
    }
}
