<?php

namespace Database\Seeders;

use App\Models\Criteria;
use Illuminate\Database\Seeder;

class CriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $examples = [
            [
                'code' => 'C1',
                'name' => 'Pekerjaan',
                'weight' => 25,
                'type' => 'benefit'
            ],
            [
                'code' => 'C2',
                'name' => 'Penghasilan',
                'weight' => 20,
                'type' => 'benefit'
            ],
            [
                'code' => 'C3',
                'name' => 'Usia',
                'weight' => 10,
                'type' => 'benefit'
            ],
            [
                'code' => 'C4',
                'name' => 'Tanggungan',
                'weight' => 15,
                'type' => 'benefit'
            ],
            [
                'code' => 'C5',
                'name' => 'Terjangkit Covid 19',
                'weight' => 30,
                'type' => 'benefit'
            ],
        ];

        foreach ($examples as $example) {
            Criteria::create($example);
        }
    }
}
