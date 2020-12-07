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
            'date_time' => Carbon::today()->addDays(2)->addHours(14)->addMinutes(10),
        ]);
        $term1->save();
        
        $term2 = new Term([
            'screening_id' => 3,
            'hall_id' => 2,
            'date_time' => Carbon::today()->addHours(23)->addMinutes(20),
        ]);
        $term2->save();
        
        $term3 = new Term([
            'screening_id' => 2,
            'hall_id' => 1,
            'date_time' => Carbon::today()->addDays(1)->addHours(20)->addMinutes(10),
        ]);
        $term3->save();
        
        $term4 = new Term([
            'screening_id' => 4,
            'hall_id' => 1,
            'date_time' => Carbon::today()->addDays(6)->addHours(15)->addMinutes(5),
        ]);
        $term4->save();
        
        $term5 = new Term([
            'screening_id' => 5,
            'hall_id' => 2,
            'date_time' => Carbon::today()->addDays(1)->addHours(23),
        ]);
        $term5->save();
        
        $term6 = new Term([
            'screening_id' => 6,
            'hall_id' => 2,
            'date_time' => Carbon::today()->addDays(5)->addHours(21)->addMinutes(15),
        ]);
        $term6->save();
        
        $term7 = new Term([
            'screening_id' => 7,
            'hall_id' => 2,
            'date_time' => Carbon::today()->addDays(3)->addHours(12)->addMinutes(35),
        ]);
        $term7->save();
        
        $term8 = new Term([
            'screening_id' => 8,
            'hall_id' => 1,
            'date_time' => Carbon::today()->addDays(5)->addHours(12)->addMinutes(35),
        ]);
        $term8->save();
        
        $term9 = new Term([
            'screening_id' => 9,
            'hall_id' => 2,
            'date_time' => Carbon::today()->addDays(2)->addHours(22)->addMinutes(35),
        ]);
        $term9->save();
        
        $term10 = new Term([
            'screening_id' => 10,
            'hall_id' => 2,
            'date_time' => Carbon::today()->addDays(6)->addHours(15)->addMinutes(55),
        ]);
        $term10->save();
        
        $term11 = new Term([
            'screening_id' => 11,
            'hall_id' => 1,
            'date_time' => Carbon::today()->addDays(3)->addHours(16)->addMinutes(20),
        ]);
        $term11->save();
        
        $term12 = new Term([
            'screening_id' => 12,
            'hall_id' => 1,
            'date_time' => Carbon::today()->addDays(3)->addHours(11)->addMinutes(55),
        ]);
        $term12->save();
        
        $term13 = new Term([
            'screening_id' => 13,
            'hall_id' => 2,
            'date_time' => Carbon::today()->addDays(5)->addHours(18)->addMinutes(10),
        ]);
        $term13->save();
        
        $term14 = new Term([
            'screening_id' => 14,
            'hall_id' => 1,
            'date_time' => Carbon::today()->addDays(2)->addHours(21)->addMinutes(30),
        ]);
        $term14->save();
        
        $term15 = new Term([
            'screening_id' => 15,
            'hall_id' => 1,
            'date_time' => Carbon::today()->addDays(6)->addHours(19)->addMinutes(40),
        ]);
        $term15->save();
        
        $term16 = new Term([
            'screening_id' => 16,
            'hall_id' => 2,
            'date_time' => Carbon::today()->addDays(4)->addHours(18)->addMinutes(5),
        ]);
        $term16->save();
        
        $term17 = new Term([
            'screening_id' => 17,
            'hall_id' => 1,
            'date_time' => Carbon::today()->addDays(2)->addHours(17)->addMinutes(85),
        ]);
        $term17->save();
        
        $term18 = new Term([
            'screening_id' => 18,
            'hall_id' => 1,
            'date_time' => Carbon::today()->addDays(5)->addHours(22),
        ]);
        $term18->save();
        
        $term19 = new Term([
            'screening_id' => 19,
            'hall_id' => 1,
            'date_time' => Carbon::today()->addDays(4)->addHours(20)->addMinutes(30),
        ]);
        $term19->save();
        
        $term20 = new Term([
            'screening_id' => 20,
            'hall_id' => 2,
            'date_time' => Carbon::today()->addDays(2)->addHours(20)->addMinutes(30),
        ]);
        $term20->save();
        
        $term21 = new Term([
            'screening_id' => 21,
            'hall_id' => 2,
            'date_time' => Carbon::today()->addDays(6)->addHours(20)->addMinutes(5),
        ]);
        $term21->save();
        
        $term22 = new Term([
            'screening_id' => 22,
            'hall_id' => 1,
            'date_time' => Carbon::today()->addHours(21)->addMinutes(50),
        ]);
        $term22->save();
        
        $term23 = new Term([
            'screening_id' => 23,
            'hall_id' => 1,
            'date_time' => Carbon::today()->addHours(14)->addMinutes(55),
        ]);
        $term23->save();
        
        $term24 = new Term([
            'screening_id' => 24,
            'hall_id' => 1,
            'date_time' => Carbon::today()->addDays(1)->addHours(12)->addMinutes(45),
        ]);
        $term24->save();
        
        $term25 = new Term([
            'screening_id' => 25,
            'hall_id' => 2,
            'date_time' => Carbon::today()->addHours(13)->addMinutes(55),
        ]);
        $term25->save();
        
        $term26 = new Term([
            'screening_id' => 26,
            'hall_id' => 2,
            'date_time' => Carbon::today()->addDays(1)->addHours(17)->addMinutes(20),
        ]);
        $term26->save();
        
        $term27 = new Term([
            'screening_id' => 27,
            'hall_id' => 1,
            'date_time' => Carbon::today()->addDays(1)->addHours(9)->addMinutes(20),
        ]);
        $term27->save();
    }
}
