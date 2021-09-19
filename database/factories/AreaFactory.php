<?php

namespace Database\Factories;

use App\Models\Area;
use App\Models\State;
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
            'delivery_cost' => rand(10,70),
            'return_cost' => rand(10,70),
            'replacement_cost' => rand(10,70),
            'over_weight_cost' => rand(10,70),
            'time_delivery' => rand(10,70),
            'zone_id' =>  Zone::all()->random()->id,

        ];
    }
}
