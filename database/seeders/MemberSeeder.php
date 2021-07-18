<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Members\Member::factory(3000)->create();
    }
}
