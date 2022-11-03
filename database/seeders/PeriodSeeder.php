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

        foreach (range(1, 3) as $key => $value) {
            Period::create([
                'title' => '2022/2023 - Gelombang ' . $value,
                'quota' => $faker->numberBetween(75, 75),
                'start_date' => $faker->dateTimeBetween(now(), '+5 day'),
                'end_date' => $faker->dateTimeBetween('1 month', '+1 month'),
                'status' => $value == 3 ? 'ongoing' : 'closed',
            ]);
        }
    }
}
