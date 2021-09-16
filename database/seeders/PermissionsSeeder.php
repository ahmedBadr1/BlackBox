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
        ];
        foreach ($this->permissions as $permission){
            Permission::findOrCreate($permission);
        }

        // create roles and assign existing permissions
        $role0 = Role::findOrCreate('client');
        $role0->givePermissionTo('dashboard');

        $role1 = Role::findOrCreate('editor');
        $role1->givePermissionTo('role-show');
        $role1->givePermissionTo('user-show');
        $role1->givePermissionTo('area-show');
        $role1->givePermissionTo('dashboard');

        $role2 = Role::findOrCreate('admin');
        $role2->givePermissionTo('role-show');
        $role2->givePermissionTo('role-edit');
        $role2->givePermissionTo('area-show');
        $role2->givePermissionTo('area-create');
        $role2->givePermissionTo('user-create');
        $role2->givePermissionTo('user-show');
        $role2->givePermissionTo('dashboard');

        $role3 = Role::findOrCreate('Feedback');
        // gets all permissions via Gate::before rule; see AuthServiceProvider


        // gets all permissions via Gate::before rule; see AuthServiceProvider

        // create demo users

        $password = Hash::make('client@bagyexpress.com');
        $user = \App\Models\User::factory()->create([
            'name' => 'client',
            'email' => 'client@bagyexpress.com',
            'phone' => '01100068386',
            'state' => 'القاهرة',
            'hearAboutUs' => 'system',
            'password'=>$password,

        ]);
        $user->assignRole($role0);

        $password = Hash::make('editor@bagyexpress.com');
        $user = \App\Models\User::factory()->create([
            'name' => 'editor',
            'email' => 'editor@bagyexpress.com',
            'phone' => '01100068386',
            'state' => 'القاهرة',
            'hearAboutUs' => 'system',
            'password'=>$password,

        ]);
        $user->assignRole($role1);

        $password = Hash::make('kimo@bagyexpress.com');
        $user = \App\Models\User::factory()->create([
            'name' => 'kimo',
            'email' => 'kimo@bagyexpress.com',
            'phone' => '01090007769',
            'state' => 'القاهرة',
            'hearAboutUs' => 'system',
            'password'=>$password,

        ]);
        $user->assignRole($role2);
        $password = Hash::make('feedback');

        $user = \App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@bagyexpress.com',
            'phone' => '01098281638',
            'state' => 'القاهرة',
            'hearAboutUs' => 'system',
            'password'=>$password,

        ]);
        $user->assignRole($role3);

    }
}
