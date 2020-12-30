<?php


namespace App\Services;

use App\Models\Movie;
use Illuminate\Support\Facades\Storage;
use App\Models\Term;
use App\Models\Screening;
use Carbon\Carbon;

final class ScreeningService
{
    private $data;
    
    public function __construct($data)
    {
        $this->data = $data;
    }
    
    public function createScreening()
    {
        $parsedMovieData = json_decode($this->data['movieForScreeningSelect'], true);
        $movieId = $parsedMovieData['id'];
        $screening = Screening::create([
            'movie_id' => $movieId,
            'viewers' => 0,
        ]);
        
        $hallId = json_decode($this->data['datesForHallSelect'], true)['id'];
        Term::create([
            'screening_id' => $screening->id,
            'hall_id' => $hallId,
            'date_time' => Carbon::parse($this->data['term'] . ' ' . $this->data['time']),
        ]);
        
        $request = request();
        $request->session()->flash('newScreening', $parsedMovieData['title']);
    }
    
    public function updateScreening()
    {
        $parsedScreeningData = json_decode($this->data['movieForEditScreening'], true);
        
        $termId = $parsedScreeningData['term']['id'];
        $term = Term::findOrFail($termId);
        $term->update([
            'date_time' => Carbon::parse($this->data['modifyTerm'] . ' ' . $this->data['modifyTime']),
        ]);
        
        if (!empty($this->data['changedHall'])) {
            $parsedHallData = json_decode($this->data['changedHall'], true);
            $term->update([
                'hall_id' => $parsedHallData['id'],
            ]);
        }
        
        $term->save();
        
        $request = request();
        $request->session()->flash('screeningEdited', true);
    }
    
    public function removeScreening()
    {
        $parsedScreeningData = json_decode($this->data['movieForEditScreening'], true);
        
        Screening::findOrFail($parsedScreeningData['id'])->delete();
        
        $request = request();
        $request->session()->flash('deletedScreening', Movie::find($parsedScreeningData['movie_id'])->title);
    }
}
    