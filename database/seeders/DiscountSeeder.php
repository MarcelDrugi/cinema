<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Discount;

class DiscountSeeder extends Seeder
{
    public function run()
    {
        $discount1 = new Discount([
            'user_id' => 1,
            'code' => 'abcdefghij123456',
            'value' => 0.2,
        ]);
        $discount1->save();
        
        $discount2 = new Discount([
            'user_id' => 1,
            'code' => '1abc2abc3abc4abc',
            'value' => 0.15,
        ]);
        $discount2->save();
    }
}
