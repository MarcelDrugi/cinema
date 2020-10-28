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
            'date_time' => '2020-11-23 21:55'
        ]);
        $term1->save();
        
        $term2 = new Term([
            'screening_id' => 2,
            'hall_id' => 2,
            'date_time' => '2020-11-24 19:20'
        ]);
        $term2->save();
        
        $term2 = new Term([
            'screening_id' => 3,
            'hall_id' => 1,
            'date_time' => '2020-11-23 20:10'
        ]);
        $term2->save();
    }
}
