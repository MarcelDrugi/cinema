<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pricing;

class PricingSeeder extends Seeder
{
    public function run()
    {
        $monday = new Pricing([
            'week_day' => 'Monday',
            'normal' => 25,
            'school' => 15,
            'senior' => 20,
        ]);
        $monday->save();
        
        $tuesday = new Pricing([
            'week_day' => 'Tuesday',
            'normal' => 20,
            'school' => 12,
            'senior' => 16,
        ]);
        $tuesday->save();
        
        $wendsday = new Pricing([
            'week_day' => 'Wednesday',
            'normal' => 20,
            'school' => 12,
            'senior' => 16,
        ]);
        $wendsday->save();
        
        $thursday = new Pricing([
            'week_day' => 'Thursday',
            'normal' => 20,
            'school' => 12,
            'senior' => 16,
        ]);
        $thursday->save();
        
        $friday = new Pricing([
            'week_day' => 'Friday',
            'normal' => 20,
            'school' => 12,
            'senior' => 16,
        ]);
        $friday->save();
        
        $saturday = new Pricing([
            'week_day' => 'Saturday',
            'normal' => 25,
            'school' => 16,
            'senior' => 18,
        ]);
        $saturday->save();
        
        $sunday = new Pricing([
            'week_day' => 'Sunday',
            'normal' => 25,
            'school' => 16,
            'senior' => 18,
        ]);
        $sunday->save();
    }
}
