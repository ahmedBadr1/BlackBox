<?php

namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();




//        \App\Models\Receipt::factory(10)->create();
        $this->call(PermissionsSeeder::class);
        $this->call(ConstantsSeeder::class);


        \App\Models\Zone::factory(10)->create();
        \App\Models\Area::factory(25)->create();
        \App\Models\Location::factory(25)->create();
        Branch::factory()->create([
            'name'=> 'main' ,
            'phone'=> '01999999999' ,
            'location_id'=> 1,
            'user_id'=> 1 ,
            'state_id'=> 1 ,
            'active' => true,
        ]);
        \App\Models\Branch::factory(10)->create();

        \App\Models\User::factory(20)->create()->each(function($user) {
            $role = Role::whereNotIn('name', ['feedback'])->inRandomOrder()->first();
            $user->assignRole($role);
        });

        \App\Models\Order::factory(200)->create();

        \App\Models\Task::factory(50)->create();
    }
}
