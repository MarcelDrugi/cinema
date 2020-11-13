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
        return $this->belongsTo('App\Models\Screening');
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
        
        self::creating(function($model) {
            $dayOfWeek = $model->day();
            $pricing = Pricing::where('week_day', $dayOfWeek)->first();
            $model->pricing()->associate($pricing);
        });
    }
    
    /**
     * Method is public, becouse it is called in the template too.
     * @return string
     */
    public function day()
    {
        $date = $this->date_time;
        $unixTimestamp = strtotime($date);
        $dayOfWeek = date("l", $unixTimestamp);
        return $dayOfWeek;
    }
    
    public function time()
    {
        return date('H:i', strtotime($this->date_time));
    }
    
    public function date()
    {
        return date('m:d', strtotime($this->date_time));
    }
}
