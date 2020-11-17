<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Screening;
use App\Models\Term;
use Carbon\Carbon;
use Carbon\Exceptions\InvalidFormatException;
use App\Models\Movie;

class EditScreeningRequest extends FormRequest
{
    public function rules()
    {
        return [
            'modifyTerm' => [
                'bail',
                'required',
                function($attribute, $value, $fail) {
                    try {
                        Carbon::parse($value);
                    }
                    catch (InvalidFormatException $e) {
                        $fail(__('Wrong date format.'));
                    }
                },
                function($attribute, $value, $fail) {
                    $newTermBegin = Carbon::parse($value. ' ' . $this->input('modifyTime'));
                    $now = Carbon::now();
                    
                    if($newTermBegin < $now) {
                        $fail(__('Screening may not be in the past.'));
                    }
                    elseif ($newTermBegin > $now->addYear()) {
                        $fail(__('The date is too far away. Reservations can be made up to a year in advance.'));
                    }
                    else {
                        $parsedScreeningData = json_decode($this->input('movieForEditScreening'), true);
                        $movie = Movie::find($parsedScreeningData['movie_id']);
                        
                        $newTermEnd = $newTermBegin->copy()->addMinutes($movie->time);
                        
                        if(empty($this->input('changedHall'))) {
                            $hallId = $parsedScreeningData['term']['hall_id'];
                        }
                        else {
                            $hallId = json_decode($this->input('changedHall'), true)['id'];
                        }
                        
                        $terms = Term::where('hall_id', $hallId)
                            ->where('date_time', '>', Carbon::now()->addHours(-9))
                            ->get();
                        
                        foreach($terms as $term) {
                            if($term->id == $parsedScreeningData['term']['id'])
                                continue;
                                
                            $begin = Carbon::parse($term->date_time);
                            $end = $begin->copy()->addMinutes($term->screening->movie->time);
                            
                            if($newTermBegin < $begin) {
                                if($newTermEnd > $begin)
                                    $fail(__('This term is not free for the hall.'));
                            }
                            elseif($newTermBegin < $end)
                                $fail(__('This term is not free for the hall.'));
                        }
                    }
                },
            ],
            
            'modifyTime' => [
                'bail',
                'required',
                function($attribute, $value, $fail){
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
            
            'forMovie' => [
                'required',
                function($attribute, $value, $fail) {
                    if(!filter_var($value, FILTER_VALIDATE_INT))
                        $fail(__('ID must be an INTEGER'));
                },
            ],
            
            'movieForEditScreening' => [
                'required',
                function($attribute, $value, $fail) {
                    $parsedScreeningData = json_decode($value, true);
                    $screeningId = $parsedScreeningData['id'];
                    if(!filter_var($screeningId, FILTER_VALIDATE_INT))
                        $fail(__('ID must be an INTEGER'));
                },
            ],
        ];
    }
}

