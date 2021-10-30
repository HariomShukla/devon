<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::query()->truncate();
        DB::table('role_user')->truncate();
        $adminRoles = Role::where('name', 'admin')->first();
        $userRoles = Role::where('name', 'user')->first();

        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@devon.com',
            'password' => Hash::make('password')
        ]);

        $user = User::create([
            'name' => 'Generic User',
            'email' => 'user@devon.com',
            'password' => Hash::make('password')
        ]);

        $admin->roles()->attach($adminRoles);
        $user->roles()->attach($userRoles);

    }
}
