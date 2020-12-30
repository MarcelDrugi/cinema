<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Screening;
use App\Models\Term;
use Carbon\Carbon;
use Carbon\Exceptions\InvalidFormatException;

class CreateScreeningRequest extends FormRequest
{
    public function rules()
    {   
        return [
            'term' => [
                'bail',
                'required',
                function($attribute, $value, $fail)
                {
                    try {
                        Carbon::parse($value);
                    }
                    catch (InvalidFormatException $e) {
                        $fail(__('Wrong date format.'));
                    }
                },
                function($attribute, $value, $fail)
                {
                    $newTermBegin = Carbon::parse($value. ' ' . $this->input('time'));
                    $now = Carbon::now();
                    
                    if ($newTermBegin < $now)
                        $fail(__('Screening may not be in the past.'));
                    elseif ($newTermBegin > $now->addYear())
                        $fail(__('The date is too far away. Reservations can be made up to a year in advance.'));
                    else {
                        $parsedMovieData = json_decode($this->input('movieForScreeningSelect'), true);
                        $newTermEnd = $newTermBegin->copy()->addMinutes($parsedMovieData['time']);
                        
                        $hallId = json_decode($this->input('datesForHallSelect'), true)['id'];
                        
                        $terms = Term::where('hall_id', $hallId)
                            ->where('date_time', '>', Carbon::now()->addHours(-9))
                            ->get();
                        
                        foreach ($terms as $term) {
                            $begin = Carbon::parse($term->date_time);
                            $end = $begin->copy()->addMinutes($term->screening->movie->time);

                            if ($newTermBegin < $begin) {
                                if ($newTermEnd > $begin)
                                    $fail(__('This term is not free for the hall.'));
                            } elseif ($newTermBegin < $end)
                                $fail(__('This term is not free for the hall.'));
                        }
                    }
                },
            ],
            
            'time' => [
                'bail',
                'required',
                function($attribute, $value, $fail)
                {
                    if (!preg_match('/[0-2][0-9]:[0-5][0-9]/', $value))
                        $fail(__('Wrong time format.'));
                    else {
                        try {
                            Carbon::parse($value);
                        }
                        catch (InvalidFormatException $e) {
                            $fail(__('Wrong time format.'));
                        } 
                    }
                }
            ],
            
            'movieForScreeningSelect' => [
                'required',
                function($attribute, $value, $fail)
                {
                    $parsedMovieData = json_decode($value, true);
                    $movieId = $parsedMovieData['id'];
                    if (!filter_var($movieId, FILTER_VALIDATE_INT))
                        $fail(__('ID must be an INTEGER'));
                },
            ],
            
            'datesForHallSelect' => [
                'required',
                function($attribute, $value, $fail)
                {
                    $parsedHallData = json_decode($value, true);
                    $hallId = $parsedHallData['id'];
                    if (!filter_var($hallId, FILTER_VALIDATE_INT))
                        $fail(__('ID must be an INTEGER'));
                },
            ],
        ];
    }
    
    public function authorize()
    {
        return true;
    }
}
