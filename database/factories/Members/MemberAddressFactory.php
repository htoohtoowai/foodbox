<?php

namespace Database\Factories\Members;

use App\Models\Members\Member;
use App\Models\Members\MemberAddress;
use Illuminate\Database\Eloquent\Factories\Factory;

class MemberAddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MemberAddress::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'member_id' => function(){
                if(Member::count())
                    return $this->faker->randomElement(Member::pluck('id')->toArray());
                else return factory(Member::class)->create()->id;
            },
            'name_en'       => $this->faker->randomElement(['Home','Office']),
            'name_mm'       => $this->faker->randomElement(['အိမ်','ရုံး']),
            'address_en'    => $this->faker->address(),
            'address_mm'    => $this->faker->address()
        ];
    }


}



