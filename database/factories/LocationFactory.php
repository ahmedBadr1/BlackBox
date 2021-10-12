<?php

namespace Database\Factories;

use App\Models\Area;
use App\Models\Location;
use App\Models\State;
use Illuminate\Database\Eloquent\Factories\Factory;

class LocationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Location::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->city,
            'state_id' =>  State::all()->random()->id,
            'area_id' =>  Area::all()->random()->id,
            'street' => $this->faker->streetName,
            'building' => $this->faker->buildingNumber,
            'floor' => $this->faker->buildingNumber,
            'apartment' => $this->faker->numberBetween(1,60),
            'landmarks' => $this->faker->bothify(),
            'longitude' => $this->faker->longitude(),
            'latitude' => $this->faker->latitude(),
        ];
    }
}
