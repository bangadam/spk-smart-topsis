<?php

namespace Database\Seeders;

use Laravolt\Indonesia\Seeds\CitiesSeeder;
use Laravolt\Indonesia\Seeds\VillagesSeeder;
use Laravolt\Indonesia\Seeds\DistrictsSeeder;
use Laravolt\Indonesia\Seeds\ProvincesSeeder;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Master
        $this->call([
            ProvincesSeeder::class,
            CitiesSeeder::class,
            DistrictsSeeder::class,
            VillagesSeeder::class,

            RoleSeeder::class,
            AdminSeeder::class,
            SurveyorSeeder::class,
            // PopulationSeeder::class,
            CriteriaSeeder::class,
            PeriodSeeder::class,
        ]);

        // Secondary
        $this->call([
            SubCriteriaSeeder::class,
            AssesmentAidSeeder::class,
        ]);
    }
}
