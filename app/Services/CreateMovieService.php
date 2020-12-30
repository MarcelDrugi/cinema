<?php


namespace App\Services;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

final class CreateMovieService
{
    private $data;
    
    public function __construct($data)
    {
        $this->data = $data;
    }
    
    public function createMovie()
    {
        $movie = Movie::create([
            'title' => $this->data['newTitle'],
            'description' => $this->data['newDescription'],
            'published' => $this->data['newPublished'],
            'time' => $this->data['newTime'],
            'age_limit' => $this->data['newAge_limit'],
            'new_movie' => false,
        ]);
        
        if (!empty($this->data['newNew_movie'])) {
            if ($this->data['newNew_movie'] == 'on') {
                $movie->new_movie = true;
                $movie->save();
            }
        } else {
            $movie->new_movie = false;
            $movie->save();
        }
        
        if (!empty($this->data['newPoster'])) {
            $s3 = Storage::disk('s3');
            $s3->delete(substr($this->data['newPoster'], 50));
            
            $request = request();
            $path = $request->file('newPoster')->store('posters', 's3');
            $url = $s3->url($path);
            
            $movie->poster = $url;
            $movie->save();
        }
    }
}
    