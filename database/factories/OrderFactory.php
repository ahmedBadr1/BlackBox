<?php

namespace Database\Factories;

use App\Models\Area;
use App\Models\Order;
use App\Models\State;
use App\Models\Status;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_name' => $this->faker->company(),
            'value' => $this->faker->numerify(),
            'cust_name' => $this->faker->company(),
            'cust_num' => $this->faker->phoneNumber(),
            'address' => $this->faker->streetAddress(),
            'area_id' => Area::all()->random()->id,
            'quantity' => $this->faker->numberBetween(1,10),
            'notes' => $this->faker->sentence(),
            'status_id' => Status::all()->random()->id,
            'user_id'  =>  User::all()->random()->id,
            'total'  =>  $this->faker->numerify(),
        ];
    }
}
