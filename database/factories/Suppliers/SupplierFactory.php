<?php

namespace Database\Factories\Suppliers;

use App\Models\Suppliers\Supplier;
use App\Models\Town;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SupplierFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Supplier::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'supplier_category' => $this->faker->randomElement([1,2]),
            'name_en' => $this->faker->name(),
            'name_mm' => 'mm_'.$this->faker->name()
        ];
    }


}

