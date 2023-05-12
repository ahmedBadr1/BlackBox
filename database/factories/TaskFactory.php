<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Task::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'type' => Task::$types[rand(0,2)],
            'location_id' => 1,
            'due_to'=> $this->faker->dateTime(),
            'delivery_id'=> User::role(['delivery'])->pluck('id')->random(),
            'user_id'=> User::role(['seller'])->pluck('id')->random()
            //
        ];
    }
}
