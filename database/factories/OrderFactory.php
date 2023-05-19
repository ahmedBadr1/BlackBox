<?php

namespace Database\Factories;

use App\Models\Area;
use App\Models\Order;
use App\Models\System\Status;
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
            'type'  =>  Order::$types[rand(0,3)],
            'product'=> [
                'name' =>  $this->faker->company(),
                'description' =>  $this->faker->sentence(),
                'value' =>  $this->faker->numberBetween(20,200),
                'quantity' => $this->faker->numberBetween(1,5),

            ],
            'consignee' => [
                'cust_name' => $this->faker->firstName(),
                'cust_num' => $this->faker->phoneNumber(),
                'address' => $this->faker->streetAddress(),
            ],
            'details' => [
                'package_type' =>  $this->faker->creditCardType(),
                'package_weight' => $this->faker->numberBetween(1,10),
                'deliver_before' => $this->faker->dateTimeThisMonth(),
                'cod' => $this->faker->boolean(),
                'notes' => $this->faker->sentence(),
            ],

            'area_id' => Area::all()->random()->id,

            'status_id' => Status::all()->random()->id,
            'user_id'  =>  User::all()->random()->id,
            'delivery_id' => User::role('delivery')->inRandomOrder()->first()->id,
            'cost'  =>  $this->faker->numerify(),
            'sub_total'  =>  $this->faker->numerify(),
            'discount'  =>  $this->faker->numerify(),
            'tax'  =>  $this->faker->numerify(),
            'total'  =>  $this->faker->numerify(),
            'created_at' => $this->faker->dateTimeBetween('-6month','now')
        ];
    }
}
