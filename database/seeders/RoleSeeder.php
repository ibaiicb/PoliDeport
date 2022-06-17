<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* Create roles */
        $superAdminRole =  Role::create(['name' => 'Super Admin']);
        $adminRole =  Role::create(['name' => 'Admin']);
        $clientRole =  Role::create(['name' => 'Client']);
        $generatedPasswordRole =  Role::create(['name' => 'Generated Password']);

        /* Create permissions and assign them to a role */

        //Super Admin can do anything except buy products
        Permission::create(['name' => 'create admin'])->assignRole($superAdminRole);
        Permission::create(['name' => 'read admin'])->assignRole($superAdminRole);
        Permission::create(['name' => 'update admin'])->assignRole($superAdminRole);
        Permission::create(['name' => 'delete admin'])->assignRole($superAdminRole);

        Permission::create(['name' => 'soft-delete admin'])->assignRole($superAdminRole);
        Permission::create(['name' => 'restore admin'])->assignRole($superAdminRole);
        Permission::create(['name' => 'delete client'])->assignRole($superAdminRole);
        Permission::create(['name' => 'delete product'])->assignRole($superAdminRole);

        Permission::create(['name' => 'show graphics'])->assignRole($superAdminRole, $adminRole);

        //Super Admin and Admin can create, read, update and delete products and clients
        Permission::create(['name' => 'create product'])->assignRole($superAdminRole, $adminRole);
        Permission::create(['name' => 'read product'])->assignRole($superAdminRole, $adminRole, $clientRole);
        Permission::create(['name' => 'update product'])->assignRole($superAdminRole, $adminRole);
        Permission::create(['name' => 'soft-delete product'])->assignRole($superAdminRole, $adminRole);

        Permission::create(['name' => 'create client'])->assignRole($superAdminRole, $adminRole);
        Permission::create(['name' => 'read client'])->assignRole($superAdminRole, $adminRole);
        Permission::create(['name' => 'show client'])->assignRole($superAdminRole, $adminRole);
        Permission::create(['name' => 'show admin'])->assignRole($adminRole);
        Permission::create(['name' => 'soft-delete client'])->assignRole($superAdminRole, $adminRole);
        Permission::create(['name' => 'restore client'])->assignRole($superAdminRole, $adminRole);

        //Client can read and buy products
        Permission::create(['name' => 'buy product'])->assignRole($clientRole);

        //User who was created by an Admin, that needs to regenerate a new password for security
        Permission::create(['name' => 'generated password'])->assignRole($generatedPasswordRole);
    }
}
