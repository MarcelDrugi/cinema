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
    }
}
