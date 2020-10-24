<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Discount;

class DiscountSeeder extends Seeder
{
    public function run()
    {
        $discount = new Discount([
            'user_id' => 1,
            'code' => 'abcdefghij123456',
            'value' => 0.2,
        ]);
        $discount->save();
    }
}
