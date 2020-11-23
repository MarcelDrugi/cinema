<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Movie;

class MovieSeeder extends Seeder
{
    public function run()
    {
        $movie1 = new Movie([
            'title' => 'Przeminęło z wiatrem',
            'description' => <<<EOD
            Ekranizacja powieści Margaret Mitchell. Beztroska i bogata Scarlett O Hara wikła się w 
            burzliwy związek z Rhettem Butlerem.
            EOD,
            'published' => 1939,
            'time' => 226,
            'age_limit' => 12,
            'new_movie' => true,
        ]);
        $movie1->save();
        
        $movie2 = new Movie([
            'title' => 'Rocky',
            'description' => <<<EOD
            Historia Rocky'ego Balboa, boksera-amatora, któremu nadarza się okazja stoczenia walki
            o tytuł mistrza świata wagi ciężkiej.
            EOD,
            'published' => 1976,
            'time' => 119,
            'age_limit' => 12,
            'new_movie' => false,
        ]);
        $movie2->save();
        
        $movie3 = new Movie([
            'title' => 'Ben Hur',
            'description' => <<<EOD
            Wygnany z kraju przez swojego przyjaciela izraelski książę spotyka na pustyni Chrystusa. 
            Nauki Jezusa odmieniają życie bohatera.
            EOD,
            'published' => 1959,
            'time' => 212,
            'age_limit' => 12,
            'new_movie' => false,
        ]);
        $movie3->save();
    }
}
