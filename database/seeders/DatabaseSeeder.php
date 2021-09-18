<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

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
        \App\Models\Zone::factory(10)->create();
//        \App\Models\Area::factory(10)->create();
//       \App\Models\Branch::factory(10)->create();
//        \App\Models\Order::factory(10)->create();
//        \App\Models\Receipt::factory(10)->create();
        $this->call(PermissionsSeeder::class);
    }
}
