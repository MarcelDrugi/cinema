<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Hall;
use App\Models\Information;

class InformationSeeder extends Seeder
{
    public function run()
    {
        Information::create([
            'place' => 'homepage_slider',
            'content' => '',
            'max_length' => '130',
        ]);
        
        Information::create([
            'place' => 'homepage_top',
            'content' => '',
            'max_length' => '210',
        ]);
        
        Information::create([
            'place' => 'homepage_bottom',
            'content' => '',
            'max_length' => '190',
        ]);
        
        Information::create([
            'place' => 'repertoire',
            'content' => '',
            'max_length' => '220',
        ]);
        
        Information::create([
            'place' => 'pricing',
            'content' => '',
            'max_length' => '250',
        ]);
        
        Information::create([
            'place' => 'aboute-bottom',
            'content' => '',
            'max_length' => '310',
        ]);
        
        Information::create([
            'place' => 'aboute-side',
            'content' => '',
            'max_length' => '110',
        ]);
        
        Information::create([
            'place' => 'api',
            'content' => '',
            'max_length' => '190',
        ]);
    }
}
