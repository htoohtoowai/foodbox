<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('units')->insert([
            [
            'name_en' => 'Pyi',
            'name_mm' => 'ပြည်'
            ],
            [
                'name_en' => 'Sait',
                'name_mm' => 'စိတ်'
            ],
            [
                'name_en' => 'Chae',
                'name_mm' => 'ခွဲ'
            ],
            [
                'name_en' => 'Tinn',
                'name_mm' => 'တင်း'
            ],
            [
            'name_en' => 'Kyatthar',
            'name_mm' => 'ကျပ်သား'
            ],
            [
                'name_en' => 'Patthar',
                'name_mm' => 'ပိဿာ'
            ],
            [
                'name_en' => 'Kyat',
                'name_mm' => 'ကျပ်'
            ],
            [
                'name_en' => 'Box',
                'name_mm' => 'ဘောက်'
            ],
            [
            'name_en' => 'Pic',
            'name_mm' => 'ခု'
            ],
            [
                'name_en' => 'Card',
                'name_mm' => 'ကဒ်'
            ],
            [
                'name_en' => 'People',
                'name_mm' => 'ယောက်'
            ],
            [
                'name_en' => 'Lone',
                'name_mm' => 'လုံး'
            ]
        ]
        );
    }
}
