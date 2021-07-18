<?php

namespace Database\Factories\Members;

use App\Models\Members\Member;
use App\Models\Town;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class MemberFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Member::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'username' => $this->faker->e164PhoneNumber(),
            'name' => $this->faker->name(),
            'level' => $this->faker->randomElement([1,2,3]),
            'town_pcode' =>function(){
                if(Town::count())
                    return $this->faker->randomElement(Town::pluck('town_pcode')->toArray());
                else return factory(Town::class)->create()->town_pcode;
            },
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'is_verified' => rand(0,1),
            'created_at' => $this->faker->dateTime($max = 'now', $timezone = null),
            'updated_at' => $this->faker->dateTime($max = 'now', $timezone = null)

        ];
    }


}

