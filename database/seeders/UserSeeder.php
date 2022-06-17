<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
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
        User::factory()->count(1)->create(['name' => 'super admin', 'username' => 'super admin', 'address' => '6080 Ferry Extension', 'email' => 'superadmin@admin.com'])->each(function ($user) {
            $user->assignRole('Super Admin');
        });

        User::factory()->count(1)->create(['name' => 'admin', 'username' => 'admin', 'address' => '641 Cyrus Forks', 'email' => 'admin@admin.com', 'password' => Hash::make('12345')])->each(function ($user) {
            $user->assignRole('Admin');
        });

        User::factory()->count(9)->create()->each(function ($user) {
            $user->assignRole('Admin');
        });

        User::factory()->count(1)->create(['name' => 'user', 'username' => 'user', 'address' => '773 Jordane Ridges', 'email' => 'user@user.com', 'password' => Hash::make('12345')])->each(function ($user) {
            $user->assignRole('Client');
        });

        User::factory()->count(49)->create()->each(function ($user) {
            $user->assignRole('Client');
        });
    }
}
