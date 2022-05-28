<?php

namespace Database\Seeders;

use App\Models\Period;
use Illuminate\Database\Seeder;

class PeriodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');

        foreach (range(1, 10) as $key => $value) {
            Period::create([
                'title' => '2022/2023 - Gelombang ' . $value,
                'quota' => $faker->numberBetween(75, 75),
                'start_date' => $faker->dateTimeBetween('-1 years', '+1 years'),
                'end_date' => $faker->dateTimeBetween('-1 years', '+1 years'),
                'status' => $value == 10 ? 'ongoing' : 'closed',
            ]);
        }
    }
}
