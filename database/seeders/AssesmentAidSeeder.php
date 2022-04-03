<?php

namespace Database\Seeders;

use App\Models\Criteria;
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

        foreach ($populations as $key_person => $person) {
            foreach ($criterias as $key_criteria => $criteria) {
                // get random only one record subcriteria from criteria
                $subcriteria = SubCriteria::where('criteria_id', $criteria->id)->inRandomOrder()->first();

                // random wieght in array 20, 40, 60, 80, 100
                $weight = [20, 40, 60, 80, 100];
                $random_weight = $weight[array_rand($weight)];

                // create assesment aid
                $person->populationAssesment()->create([
                    'sub_criteria_id' => $subcriteria->id,
                    'value' => $random_weight,
                ]);
            }
        }
    }
}
