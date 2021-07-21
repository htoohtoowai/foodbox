<?php

namespace Database\Factories\Suppliers;

use App\Models\Suppliers\Supplier;
use App\Models\Suppliers\SupplierAddress;
use App\Models\Town;
use Illuminate\Database\Eloquent\Factories\Factory;

class SupplierAddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SupplierAddress::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'supplier_id' => function(){
                if(Supplier::count())
                    return $this->faker->randomElement(Supplier::pluck('id')->toArray());
                else return factory(Supplier::class)->create()->id;
            },
            'town_pcode' =>function(){
                if(Town::count())
                    return $this->faker->randomElement(Town::pluck('town_pcode')->toArray());
                else return factory(Town::class)->create()->town_pcode;
            },
            'phone' => $this->faker->e164PhoneNumber(),
            'address_en'    => $this->faker->address(),
            'address_mm'    => 'mm_'.$this->faker->address()
        ];
    }


}



