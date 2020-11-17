<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Term;

class TermSeeder extends Seeder
{
    public function run()
    {
        $term1 = new Term([
            'screening_id' => 1,
            'hall_id' => 1,
            'date_time' => '2020-11-17 21:55'
        ]);
        $term1->save();
        
        $term2 = new Term([
            'screening_id' => 2,
            'hall_id' => 2,
            'date_time' => '2020-11-21 19:20'
        ]);
        $term2->save();
        
        $term3 = new Term([
            'screening_id' => 3,
            'hall_id' => 2,
            'date_time' => '2020-11-17 20:10'
        ]);
        $term3->save();
        
        $term4 = new Term([
            'screening_id' => 4,
            'hall_id' => 1,
            'date_time' => '2020-11-20 18:20'
        ]);
        $term4->save();
        
        $term5 = new Term([
            'screening_id' => 5,
            'hall_id' => 2,
            'date_time' => '2020-11-20 19:00'
        ]);
        $term5->save();
    }
}
