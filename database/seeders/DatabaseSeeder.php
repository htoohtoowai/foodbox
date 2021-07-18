<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CategorySeeder::class);
        $this->call(CategoryItemSeeder::class);
        $this->call(StateRegionSeeder::class);
        $this->call(TownSeeder::class);
        $this->call(MemberSeeder::class);
        $this->call(MemberAddressSeeder::class);
    }
}
