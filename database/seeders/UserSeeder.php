<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create user factory
        $roles = Role::all();

        $faker = Factory::create();

        foreach ($roles as $role) {
            $user = \App\Models\User::create([
                'name' => $faker->name,
                'username' => $role->name,
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
            ]);

            $user->assignRole($role);
        }
    }
}
