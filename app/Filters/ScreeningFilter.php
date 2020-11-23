<?php

namespace App\Filters;


use App\Models\Screening;
use Carbon\Carbon;
use Carbon\Exceptions\InvalidFormatException;

class ScreeningFilter
{
    private $resoult, $filters;
    
    public function __construct($filters)
    {
        $this->resoult = Screening::has('future')->with('movie')->get();
        $this->filters = $filters;
    }
    
    public function resultFiltering()
    {
        foreach($this->filters as $parameter => $value) {
            
            if($parameter == 'title')
                $this->resoult = $this->resoult->where('movie.title', $value);
            
            elseif($parameter == 'sevenDays') {
                if($value == true)
                    $this->resoult = $this->resoult->where('sevenDaysTerm', '!=', null);
            }
            
            elseif($parameter == 'day') {
                
                try {
                    $day = new Carbon($value);
                }
                catch (InvalidFormatException $e) {
                    return null;
                }
                
                $this->resoult = $this->resoult
                    ->where('term.date_time', '>', $day)
                    ->where('term.date_time', '<', $day->addDay());
            }
            
            else 
                return null;
        }
        
        return $this->resoult;
    }
}
