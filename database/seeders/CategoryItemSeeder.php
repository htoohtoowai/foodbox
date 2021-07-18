<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category_items')->insert(
            [
            [
            'category_id' => 1,
            'name_en' => 'Oxygen',
            'name_mm' => 'အောက်ဆီဂျင်'
            ],
            [
                'category_id' => '1',
                'name_en' => 'Drug and Drug Accessories',
                'name_mm' => 'ဆေး နှင့် ဆေးပစ္စည်းများ'
            ],
            [
                'category_id' => '2',
                'name_en' => 'Rice',
                'name_mm' => 'ဆန်'
            ],
            [
                'category_id' => '2',
                'name_en' => 'Oil',
                'name_mm' => 'ဆီ'
            ],
            [
                'category_id' => '2',
                'name_en' => 'Shack',
                'name_mm' => 'သရေစာ'
            ],
            [
                'category_id' => '2',
                'name_en' => 'Other',
                'name_mm' => 'အခြား'
            ],
            [
                'category_id' => '3',
                'name_en' => 'Clothing ',
                'name_mm' => 'အဝတ်အထည်'
            ],
            [
                'category_id' => '3',
                'name_en' => 'Other',
                'name_mm' => 'အခြား'
            ],
            [
                'category_id' => '4',
                'name_en' => 'Delivery ',
                'name_mm' => 'ချောပို့'
            ],
            [
                'category_id' => '4',
                'name_en' => 'Queueing',
                'name_mm' => 'တန်းစီပေးခြင်း'
            ],
            [
                'category_id' => '4',
                'name_en' => 'Shopping',
                'name_mm' => 'ဈေးဝယ်ပေးခြင်း'
            ],
            ]
    );
    }
}
