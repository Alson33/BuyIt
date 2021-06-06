<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'add admin']);
        Permission::create(['name' => 'add notice']);
        Permission::create(['name' => 'add item']);

        $superAdmin = Role::create(['name' => 'superadmin']);
        $admin = Role::create(['name' => 'admin']);

        $superAdmin->syncPermissions(['add admin', 'add notice', 'add item']);
        $admin->syncPermissions(['add notice', 'add item']);

        $user = User::create([
            'name' => 'Alson',
            'email' => 'alson@gmail.com',
            'password' => Hash::make('1234567890'),
        ]);

        $user->assignRole($superAdmin);
    }
}
