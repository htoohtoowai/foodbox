<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SupplierAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Suppliers\SupplierAddress::factory(2000)->create();
    }
}
