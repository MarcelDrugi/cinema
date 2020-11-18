<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Term;
use Carbon\Carbon;

class TermSeeder extends Seeder
{
    public function run()
    {
        $term1 = new Term([
            'screening_id' => 1,
            'hall_id' => 1,
            'date_time' => Carbon::today()->addDays(1)->addHours(16)->addMinutes(25),
        ]);
        $term1->save();
        
        $term2 = new Term([
            'screening_id' => 2,
            'hall_id' => 2,
            'date_time' => Carbon::today()->addDays(2)->addHours(19)->addMinutes(40),
        ]);
        $term2->save();
        
        $term3 = new Term([
            'screening_id' => 3,
            'hall_id' => 1,
            'date_time' => Carbon::today()->addDays(2)->addHours(20)->addMinutes(10),
        ]);
        $term3->save();
        
        $term4 = new Term([
            'screening_id' => 4,
            'hall_id' => 1,
            'date_time' => Carbon::today()->addDays(4)->addHours(22)->addMinutes(5),
        ]);
        $term4->save();
        
        $term5 = new Term([
            'screening_id' => 5,
            'hall_id' => 2,
            'date_time' => Carbon::today()->addDays(5)->addHours(21),
        ]);
        $term5->save();
    }
}
