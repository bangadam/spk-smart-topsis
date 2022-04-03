<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create user factory
        $roles = Role::where('name', 'admin')->first();

        $faker = Factory::create('id_ID');

        $user = \App\Models\User::create([
            'name' => $faker->name,
            'email' => $roles->name . '@example.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
        ]);

        $user->assignRole($roles);

        // create account
        $user->account()->create([
            'full_name' => $faker->name,
            'photo' => $faker->imageUrl(200, 200),
            'village_id' => $faker->numberBetween(1, 100),
            'address' => $faker->address,
            'phone' => $faker->phoneNumber,
        ]);
    }
}
