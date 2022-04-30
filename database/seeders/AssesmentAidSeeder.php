<?php

namespace Database\Seeders;

use App\Models\Criteria;
use App\Models\Period;
use App\Models\Population;
use App\Models\SubCriteria;
use Illuminate\Database\Seeder;

class AssesmentAidSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $populations = Population::all();
        $criterias = Criteria::all();
        $faker = \Faker\Factory::create('id_ID');

        // 80	60	40	40	20
        // 100	100	40	40	100
        // 20	40	40	20	80
        // 60	60	20	20	40
        // 80	80	20	40	80

        // $weights = [
        //     [80,	60,	40,	40,	20],
        //     [100,100,40	,40	,100],
        //     [20,	40,	40,	20,	80],
        //     [60,	60,	20,	20,	40],
        //     [80,	80,	20,	40,	80],
        // ];

        foreach ($populations as $key_person => $person) {
            // create population assesment
            $population_assesmnet = $person->population_assesments()->create([
                'date' => now(),
                'period_id' => Period::where('status', 'ongoing')->inRandomOrder()->first()->id,
            ]);

            foreach ($criterias as $key_criteria => $criteria) {
                // get random only one record subcriteria from criteria
                $subcriteria = SubCriteria::where('criteria_id', $criteria->id)->inRandomOrder()->first();

                // random wieght in array 20, 40, 60, 80, 100
                // $weight = $weights[$key_person][$key_criteria];
                $weight = $faker->randomElement([20, 40, 60, 80, 100]);

                // create population assesment detail
                $population_assesmnet->populationAssesmentDetail()->create([
                    'sub_criteria_id' => $subcriteria->id,
                    'value' => $weight,
                ]);

            }
        }
    }
}
