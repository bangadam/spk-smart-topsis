<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class PopulationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create user factory
        $roles = Role::where('name', 'receiver')->first();

        $faker = Factory::create('id_ID');

        foreach (range(1, 5) as $index) {
            $user = \App\Models\User::create([
                'name' => $faker->name,
                'email' => $roles->name . $index .'@example.com',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
            ]);

            $user->assignRole($roles);

            // create account
            $name = $faker->name;
            $phone = $faker->phoneNumber;
            $village_id = $faker->numberBetween(1, 100);
            $address = $faker->address;
            $gender = $faker->randomElement(['male', 'female']);


            $user->account()->create([
                'full_name' => $name,
                'photo' => $faker->imageUrl(200, 200),
                'village_id' => $village_id,
                'address' => $address,
                'phone' => $phone,
            ]);

            // RT
            $user_rt = User::whereHas('roles', function($query) {
                $query->where('name', 'surveyor');
            })->inRandomOrder()->first();

            // create population
            $user->population()->create([
                'card_id_number' => $faker->nik(),
                'family_card_id' => $faker->nik(),
                'name' => $name,
                'phone_number' => $phone,
                'village_id' => $village_id,
                'address' => $address,
                'birth_date' => $faker->dateTimeBetween('-60 years', '-18 years'),
                'gender' => $gender,
                'zip_code' => $faker->postcode,
                'created_by' => $user_rt->id,
            ]);
        }
    }
}
