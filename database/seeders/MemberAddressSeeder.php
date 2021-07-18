<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MemberAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       \App\Models\Members\MemberAddress::factory(4500)->create();
    }
}
