<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
            'name_en' => 'Health',
            'name_mm' => 'ကျန်းမာရေး'
            ],
            [
                'name_en' => 'Food',
                'name_mm' => 'စားသောက်ကုန်'
            ],
            [
                'name_en' => 'Accessory',
                'name_mm' => 'အသုံးအဆောင်'
            ],
            [
                'name_en' => 'Other Service',
                'name_mm' => 'အခြားဝန်ဆောင်မှု'
            ]
        ]
        );
    }
}
