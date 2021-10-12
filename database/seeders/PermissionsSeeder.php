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

        // create roles and assign existing permissions
        $role0 = Role::findOrCreate('seller');
        $role0->givePermissionTo('dashboard');

        $role1 = Role::findOrCreate('delivery');
        $role1->givePermissionTo('order-show');
        $role1->givePermissionTo('order-status');
        $role1->givePermissionTo('area-show');
        $role1->givePermissionTo('dashboard');

        $role2 = Role::findOrCreate('manager');
        $role2->givePermissionTo('role-show');
        $role2->givePermissionTo('role-edit');
        $role2->givePermissionTo('area-show');
        $role2->givePermissionTo('area-create');
        $role2->givePermissionTo('user-create');
        $role2->givePermissionTo('user-show');
        $role2->givePermissionTo('dashboard');

        //$role2 = Role::findOrCreate('owner');


        $role3 = Role::findOrCreate('Feedback');
        // gets all permissions via Gate::before rule; see AuthServiceProvider


        // gets all permissions via Gate::before rule; see AuthServiceProvider

        // create demo users

        $password = Hash::make('seller@bagyexpress.com');
        $user = \App\Models\User::factory()->create([
            'name' => 'seller',
            'email' => 'seller@bagyexpress.com',
            'phone' => '01100068386',
            'state_id' => '1',
            'hearAboutUs' => 'system',
            'password'=>$password,


        ]);
        $user->assignRole($role0);


        $user = \App\Models\User::factory()->create([
            'name' => 'delivery',
            'email' => 'delivery@bagyexpress.com',
            'phone' => '01100068386',
            'state_id' => '1',
            'hearAboutUs' => 'system',
            'password'=>bcrypt('delivery@bagyexpress.com'),

        ]);
        $user->assignRole($role1);

        $password = Hash::make('kimo@bagyexpress.com');
        $user = \App\Models\User::factory()->create([
            'name' => 'kimo',
            'email' => 'kimo@bagyexpress.com',
            'phone' => '01090007769',
            'state_id' => '1',
            'hearAboutUs' => 'system',
            'password'=>$password,

        ]);
        $user->assignRole($role2);
        $password = Hash::make('feedback');

        $user = \App\Models\User::factory()->create([
            'name' => 'feedback',
            'email' => 'admin@bagyexpress.com',
            'phone' => '01098281638',
            'state_id' => '1',
            'hearAboutUs' => 'system',
            'password'=>$password,

        ]);
        $user->assignRole($role3);

    }
}
