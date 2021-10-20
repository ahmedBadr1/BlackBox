<?php

namespace Database\Factories;

use App\Models\Branch;
use App\Models\Location;
use App\Models\State;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BranchFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Branch::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->citySuffix(),
            'phone' => $this->faker->unique()->phoneNumber(),
            'location_id' => Location::all()->random()->id,
            'state_id' =>  State::all()->random()->id,
            'user_id' => User::role(['manager'])->pluck('id')->random(),
            'active' => $this->faker->boolean(),
        ];
    }
}
