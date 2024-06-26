<?php

namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
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
        $this->call(ConstantsSeeder::class);
        $this->call(PermissionsSeeder::class);

        \App\Models\Zone::factory(50)->create();
        \App\Models\Area::factory(250)->create();
  //      \App\Models\Location::factory(25)->create();
        Branch::factory()->create([
            'name'=> 'main' ,
            'phone'=> '01999999999' ,
            'user_id'=> 1 ,
            'state_id'=> 1 ,
            'active' => true,
        ]);
        \App\Models\Branch::factory(10)->create();

        \App\Models\User::factory(5)->create()->each(function($user) {
            $role = Role::whereNotIn('name', ['feedback'])->inRandomOrder()->first();
            $user->assignRole($role);
        });

        \App\Models\Order::factory(500)->create();
//Artisan::call('');
        \App\Models\Task::factory(50)->create();
    }
}
