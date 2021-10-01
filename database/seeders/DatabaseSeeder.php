<?php

namespace Database\Seeders;

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

        $this->call(ConstantsSeeder::class);
        $this->call(PermissionsSeeder::class);

        \App\Models\Branch::factory(10)->create();

        \App\Models\Zone::factory(10)->create();

        \App\Models\Area::factory(25)->create();

  //      \App\Models\Order::factory(50)->create();


         \App\Models\User::factory(20)->create();
         for ($i=5 ; $i <= 14; $i++ ){
             $user = \App\Models\User::find($i) ;
             $role = Role::all()->random();
             $user->assignRole($role);
         }
        \App\Models\Task::factory(10)->create();
    }
}
