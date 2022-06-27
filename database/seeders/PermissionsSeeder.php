<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    private array $permissions = [];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        $this->permissions = [
            'dashboard',
            'messages',
            'email-send',
            'role-show',
            'role-edit',
            'role-create',
            'role-delete',
            'user-show',
            'user-edit',
            'user-create',
            'user-delete',
            'area-show',
            'area-edit',
            'area-create',
            'area-delete',
            'branch-show',
            'branch-edit',
            'branch-create',
            'branch-delete',
            'branch-assign',
            'order-show',
            'order-track',
            'order-status',
            'order-assign',
            'states',
            'task-show',
            'task-edit',
            'task-create',
            'task-delete',
            'task-assign',

        ];
        foreach ($this->permissions as $permission){
            Permission::findOrCreate($permission);
        }


        $role1 = Role::findOrCreate('Feedback');

        $role2 = Role::findOrCreate('owner');

        $role3 = Role::findOrCreate('manager');
        $role3->givePermissionTo('role-show');
        $role3->givePermissionTo('role-edit');
        $role3->givePermissionTo('area-show');
        $role3->givePermissionTo('area-create');
        $role3->givePermissionTo('user-create');
        $role3->givePermissionTo('user-show');
        $role3->givePermissionTo('dashboard');

        $role4 = Role::findOrCreate('delivery');
        $role4->givePermissionTo('order-show');
        $role4->givePermissionTo('order-status');
        $role4->givePermissionTo('area-show');
        $role4->givePermissionTo('dashboard');


        // create roles and assign existing permissions
        $role5 = Role::findOrCreate('seller');
        $role5->givePermissionTo('dashboard');



        // gets all permissions via Gate::before rule; see AuthServiceProvider


        // gets all permissions via Gate::before rule; see AuthServiceProvider

        // create demo users

        $password = Hash::make('feedback');
        $user = \App\Models\User::factory()->create([
            'name' => 'feedback',
            'email' => 'admin@blackbox.com',
            'phone' => '01098281638',
            'hearAboutUs' => 'system',
            'password'=>$password,

        ]);
        $user->assignRole($role1);

        $password = Hash::make('owner@blackbox.com');
        $user = \App\Models\User::factory()->create([
            'name' => 'owner',
            'email' => 'owner@blackbox.com',
            'phone' => '01090007769',
            'hearAboutUs' => 'system',
            'password'=>$password,
        ]);
        $user->assignRole($role2);


        $password = Hash::make('manager@blackbox.com');
        $user = \App\Models\User::factory()->create([
            'name' => 'manager',
            'email' => 'manager@blackbox.com',
            'phone' => '01090007769',
            'hearAboutUs' => 'system',
            'password'=>$password,
        ]);
        $user->assignRole($role3);




        $user = \App\Models\User::factory()->create([
            'name' => 'delivery',
            'email' => 'delivery@blackbox.com',
            'phone' => '01100068386',
            'hearAboutUs' => 'system',
            'password'=>bcrypt('delivery@blackbox.com'),

        ]);
        $user->assignRole($role4);


        $password = Hash::make('seller@blackbox.com');
        $user = \App\Models\User::factory()->create([
            'name' => 'seller',
            'email' => 'seller@blackbox.com',
            'phone' => '01100068386',
            'hearAboutUs' => 'system',
            'password'=>$password,
        ]);
        $user->assignRole($role5);




    }
}
