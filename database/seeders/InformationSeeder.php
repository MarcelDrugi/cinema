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
            'max_length' => '330',
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
            'max_length' => '410',
        ]);
        
        Information::create([
            'place' => 'pricing',
            'content' => '',
            'max_length' => '250',
        ]);
        
        Information::create([
            'place' => 'about_bottom',
            'content' => '',
            'max_length' => '510',
        ]);
        
        Information::create([
            'place' => 'about_left',
            'content' => '',
            'max_length' => '400',
        ]);
        
        Information::create([
            'place' => 'about_right',
            'content' => '',
            'max_length' => '400',
        ]);
        
        Information::create([
            'place' => 'api',
            'content' => '',
            'max_length' => '190',
        ]);
    }
}
