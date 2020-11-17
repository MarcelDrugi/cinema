<?php

namespace App\Models;

use DateTime;
use Exception;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Term extends Model
{
    use HasFactory;
    
    private $errors;
    
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
            'date_time' => function($attribute, $value, $fail) {
                if($value < Carbon::now()) {
                    $fail($attribute . ' may not be in the past.');
                }
                else {
                    $newTermBegin = Carbon::parse($value);
                    $newTermEnd = $newTermBegin->copy()->addMinutes($this->screening->movie->time);
                    $terms = Term::where('hall_id', $this->hall_id)
                        ->where('date_time', '>', Carbon::now()->addHours(-9))
                        ->get();
                    
                    foreach($terms as $term) {
                        if($term->id == $this->id)
                            continue;
                        
                        $begin = Carbon::parse($term->date_time);
                        $end = $begin->copy()->addMinutes($term->screening->movie->time);

                        if($newTermBegin < $begin) {
                            if($newTermEnd > $begin)
                                $fail('This term is not free.');
                        }
                        elseif($newTermBegin < $end)
                            $fail('This term is not free.');
                    }
                }
            },
        ];
        
        $v = Validator::make($values, $rules);
        
        $isValid = !$v->fails();
        $this->errors = $isValid ? new \Illuminate\Support\MessageBag() : $v->messages();
        
        return $isValid;
    }
}
