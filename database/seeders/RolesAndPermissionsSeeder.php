<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Reset Spatie Permission Cache
        |--------------------------------------------------------------------------
        */

        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        /*
        |--------------------------------------------------------------------------
        | Roles
        |--------------------------------------------------------------------------
        */

        $roles = [
            'Super Admin',
            'Administrator',
            'Manager',
            'IT Staff',
            'Accountant',
            'HR Staff',
            'Staff',
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate([
                'name' => $role,
                'guard_name' => 'web',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Permissions
        |--------------------------------------------------------------------------
        */

        $permissions = [
            // Users
            'view users',
            'create users',
            'edit users',
            'delete users',

            // Departments
            'view departments',
            'create departments',
            'edit departments',
            'delete departments',

            // Staff
            'view staff',
            'create staff',
            'edit staff',
            'delete staff',

            // Dashboard
            'view dashboard',

            // Reports
            'view reports',
            'create reports',
            'export reports',

            // Settings
            'view settings',
            'manage settings',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Super Admin
        |--------------------------------------------------------------------------
        */

        $superAdmin = Role::findByName('Super Admin', 'web');

        $superAdmin->syncPermissions(
            Permission::where('guard_name', 'web')->get()
        );

        /*
        |--------------------------------------------------------------------------
        | Administrator
        |--------------------------------------------------------------------------
        */

        $administrator = Role::findByName('Administrator', 'web');

        $administrator->syncPermissions([
            'view dashboard',

            'view users',
            'create users',
            'edit users',

            'view departments',
            'create departments',
            'edit departments',

            'view staff',
            'create staff',
            'edit staff',

            'view reports',
            'create reports',
            'export reports',

            'view settings',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Manager
        |--------------------------------------------------------------------------
        */

        $manager = Role::findByName('Manager', 'web');

        $manager->syncPermissions([
            'view dashboard',

            'view staff',
            'view users',

            'view reports',
            'create reports',
            'export reports',
        ]);

        /*
        |--------------------------------------------------------------------------
        | IT Staff
        |--------------------------------------------------------------------------
        */

        $itStaff = Role::findByName('IT Staff', 'web');

        $itStaff->syncPermissions([
            'view dashboard',
            'view users',
            'view staff',
            'view reports',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Accountant
        |--------------------------------------------------------------------------
        */

        $accountant = Role::findByName('Accountant', 'web');

        $accountant->syncPermissions([
            'view dashboard',
            'view reports',
            'export reports',
        ]);

        /*
        |--------------------------------------------------------------------------
        | HR Staff
        |--------------------------------------------------------------------------
        */

        $hrStaff = Role::findByName('HR Staff', 'web');

        $hrStaff->syncPermissions([
            'view dashboard',
            'view staff',
            'create staff',
            'edit staff',
            'view reports',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Staff
        |--------------------------------------------------------------------------
        */

        $staff = Role::findByName('Staff', 'web');

        $staff->syncPermissions([
            'view dashboard',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Default Super Admin Account
        |--------------------------------------------------------------------------
        */

        $admin = User::firstOrCreate(
            [
                'email' => 'admin@ees-tech.com',
            ],
            [
                'name' => 'EES-Tech Super Admin',
                'phone' => null,
                'status' => 'active',
                'password' => Hash::make('ChangeMe@123'),
            ]
        );

        $admin->syncRoles(['Super Admin']);
    }
}