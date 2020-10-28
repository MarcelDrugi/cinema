<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Hall;

class HallSeeder extends Seeder
{
    public function run()
    {
        $hall1 = new Hall([
            'name' => 'Sala A',
            'capacity' => 150
        ]);
        $hall1->save();
        
        $hall2 = new Hall([
            'name' => 'Sala B',
            'capacity' => 120
        ]);
        $hall2->save();
    }
}
