<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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
            'device-show',
            'device-edit',
            'device-create',
            'device-delete',
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
        $role1->givePermissionTo('dashboard');

        $role2 = Role::findOrCreate('admin');
        $role3->givePermissionTo('role-show');
        $role3->givePermissionTo('role-edit');
        $role2->givePermissionTo('user-create');
        $role2->givePermissionTo('user-show');
        $role2->givePermissionTo('dashboard');

        $role3 = Role::findOrCreate('Feedback');
        // gets all permissions via Gate::before rule; see AuthServiceProvider
        $role3->givePermissionTo('role-show');
        $role3->givePermissionTo('role-edit');
        $role3->givePermissionTo('role-create');
        $role3->givePermissionTo('role-delete');
        $role3->givePermissionTo('user-create');
        $role3->givePermissionTo('user-show');
        $role3->givePermissionTo('user-edit');
        $role3->givePermissionTo('user-delete');
        $role3->givePermissionTo('dashboard');

        // gets all permissions via Gate::before rule; see AuthServiceProvider

        // create demo users

        $password = Hash::make('client@bagyexpress.com');
        $user = \App\Models\User::factory()->create([
            'name' => 'editor',
            'email' => 'client@bagyexpress.com',
            'phone' => '01100068386',
            'password'=>$password,
            'role' => $role1
        ]);
        $user->assignRole($role1);

        $password = Hash::make('editor@bagyexpress.com');
        $user = \App\Models\User::factory()->create([
            'name' => 'editor',
            'email' => 'editor@easy.com',
            'phone' => '01100068386',
            'password'=>$password,
            'role' => $role1
        ]);
        $user->assignRole($role1);

        $password = Hash::make('kimo@bagyexpress.com');
        $user = \App\Models\User::factory()->create([
            'name' => 'kimo',
            'email' => 'kimo@bagyexpress.com',
            'phone' => '01090007769',
            'password'=>$password,
            'role' => $role2
        ]);
        $user->assignRole($role2);
        $password = Hash::make('feedback');

        $user = \App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@bagyexpress.com',
            'phone' => '01098281638',
            'password'=>$password,
            'role' => $role3
        ]);
        $user->assignRole($role3);

    }
}
