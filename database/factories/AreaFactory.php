<?php

namespace Database\Factories;

use App\Models\Area;
use App\Models\System\State;
use App\Models\Zone;
use Illuminate\Database\Eloquent\Factories\Factory;

class AreaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Area::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'name' => $this->faker->unique()->city(),
            'delivery_cost' => rand(10,60),
            'return_cost' => rand(5,40),
            'replacement_cost' => rand(15,50),
            'over_weight_cost' => rand(1,10),
            'delivery_time' => rand(12,96),
            'zone_id' =>  Zone::all()->random()->id,
            'state_id' => State::all()->random()->id,

        ];
    }
}
