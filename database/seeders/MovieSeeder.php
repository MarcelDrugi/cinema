<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Movie;

class MovieSeeder extends Seeder
{
    public function run()
    {
        $movie1 = new Movie([
            'title' => 'Przeminęło z wiatem',
            'description' => <<<EOD
            Ekranizacja powieści Margaret Mitchell. Beztroska i bogata Scarlett O Hara wikła się w 
            burzliwy związek z Rhettem Butlerem.
            EOD,
            'publised' => 1939,
            'time' => 226,
            'age_limit' => 12,
        ]);
        $movie1->save();
        
        $movie2 = new Movie([
            'title' => 'Rocky',
            'description' => <<<EOD
            Historia Rocky'ego Balboa, boksera-amatora, któremu nadarza się okazja stoczenia walki 
            o tytuł mistrza świata wagi ciężkiej.
            EOD,
            'publised' => 1976,
            'time' => 119,
            'age_limit' => 12
        ]);
        $movie2->save();
    }
}
