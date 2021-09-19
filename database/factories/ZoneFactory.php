<?php

namespace Database\Factories;

use App\Models\Area;
use App\Models\State;
use App\Models\Zone;
use Illuminate\Database\Eloquent\Factories\Factory;

class ZoneFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Zone::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->city(),
            'rank' => rand(1,4),
            'state_id' => State::all()->random()->id,
        ];
    }
}
