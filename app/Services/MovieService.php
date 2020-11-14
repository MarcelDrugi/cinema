<?php


namespace App\Services;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MovieService
{
    private $data;
    
    public function __construct($data)
    {
        $this->data = $data;
    }
    
    public function updateMovie()
    {
        $movie = Movie::find($this->data['id']);
        
        $movie->update([
            'title' => $this->data['title'],
            'description' => $this->data['description'],
            'published' => $this->data['published'],
            'time' => $this->data['time'],
            'age_limit' => $this->data['age_limit'],
        ]);
        
        if(!empty($this->data['new_movie']))
        {
            if($this->data['new_movie'] == 'on') {
                $movie->new_movie = true;
                $movie->save();
            }
        }
        else {
            $movie->new_movie = false;
            $movie->save();
        }
        
        if(!empty($this->data['poster'])) {
            $s3 = Storage::disk('s3');
            $s3->delete(substr($this->data['poster'], 50));
            
            $request = request();
            $path = $request->file('poster')->store('posters', 's3');
            $url = $s3->url($path);
            
            $movie->poster = $url;
            $movie->save();
        }
    }
    
    public function deleteMovie()
    {
        $movie = Movie::findOrFail($this->data['id']);
        $movie->delete();
    }
}
    