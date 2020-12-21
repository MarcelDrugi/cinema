<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Screening;

class ScreeningSeeder extends Seeder
{
    public function run()
    {
        $screening1 = new Screening([
            'movie_id' => 1,
            'viewers' => 111,
        ]);
        $screening1->save();
        
        $screening2 = new Screening([
            'movie_id' => 1,
            'viewers' => 112,
        ]);
        $screening2->save();
        
        $screening3 = new Screening([
            'movie_id' => 2,
            'viewers' => 107,
        ]);
        $screening3->save();
        
        $screening4 = new Screening([
            'movie_id' => 2,
            'viewers' => 120,
        ]);
        $screening4->save();
        
        $screening5 = new Screening([
            'movie_id' => 2,
            'viewers' => 75,
        ]);
        $screening5->save();
        
        $screening6 = new Screening([
            'movie_id' => 3,
            'viewers' => 105,
        ]);
        $screening6->save();
        
        $screening7 = new Screening([
            'movie_id' => 3,
            'viewers' => 115,
        ]);
        $screening7->save();
        
        $screening8 = new Screening([
            'movie_id' => 4,
            'viewers' => 88,
        ]);
        $screening8->save();
        
        $screening9 = new Screening([
            'movie_id' => 4,
            'viewers' => 115,
        ]);
        $screening9->save();
        
        $screening10 = new Screening([
            'movie_id' => 4,
            'viewers' => 115,
        ]);
        $screening10->save();
        
        $screening11 = new Screening([
            'movie_id' => 5,
            'viewers' => 75,
        ]);
        $screening11->save();
        
        $screening12 = new Screening([
            'movie_id' => 5,
            'viewers' => 90,
        ]);
        $screening12->save();
        
        $screening13 = new Screening([
            'movie_id' => 6,
            'viewers' => 59,
        ]);
        $screening13->save();
        
        $screening14 = new Screening([
            'movie_id' => 6,
            'viewers' => 105,
        ]);
        $screening14->save();
        
        $screening15 = new Screening([
            'movie_id' => 7,
            'viewers' => 100,
        ]);
        $screening15->save();
        
        $screening16 = new Screening([
            'movie_id' => 7,
            'viewers' => 111,
        ]);
        $screening16->save();
        
        $screening17 = new Screening([
            'movie_id' => 7,
            'viewers' => 60,
        ]);
        $screening17->save();
        
        $screening18 = new Screening([
            'movie_id' => 8,
            'viewers' => 79,
        ]);
        $screening18->save();
        
        $screening19 = new Screening([
            'movie_id' => 8,
            'viewers' => 91,
        ]);
        $screening19->save();
        
        $screening20 = new Screening([
            'movie_id' => 8,
            'viewers' => 93,
        ]);
        $screening20->save();
        
        $screening21 = new Screening([
            'movie_id' => 9,
            'viewers' => 107,
        ]);
        $screening21->save();
        
        $screening22 = new Screening([
            'movie_id' => 9,
            'viewers' => 113,
        ]);
        $screening22->save();
        
        $screening23 = new Screening([
            'movie_id' => 7,
            'viewers' => 113,
        ]);
        $screening23->save();
        
        $screening24 = new Screening([
            'movie_id' => 7,
            'viewers' => 113,
        ]);
        $screening24->save();
        
        $screening25 = new Screening([
            'movie_id' => 4,
            'viewers' => 113,
        ]);
        $screening25->save();
        
        $screening26 = new Screening([
            'movie_id' => 5,
            'viewers' => 58,
        ]);
        $screening26->save();
        
        $screening27 = new Screening([
            'movie_id' => 8,
            'viewers' => 58,
        ]);
        $screening27->save();
    }
}
