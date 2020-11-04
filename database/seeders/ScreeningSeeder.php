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
            'viewers' => 142,
        ]);
        $screening1->save();
        
        $screening2 = new Screening([
            'movie_id' => 1,
            'viewers' => 112,
        ]);
        $screening2->save();
        
        $screening3 = new Screening([
            'movie_id' => 2,
            'viewers' => 150,
        ]);
        $screening3->save();
        
        $screening4 = new Screening([
            'movie_id' => 3,
            'viewers' => 120,
        ]);
        $screening4->save();
        
        $screening5 = new Screening([
            'movie_id' => 3,
            'viewers' => 75,
        ]);
        $screening5->save();
    }
}
