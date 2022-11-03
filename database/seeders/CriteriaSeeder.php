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
                'weight' => 4,
                'type' => 'cost'
            ],
            [
                'code' => 'C2',
                'name' => 'Penghasilan',
                'weight' => 5,
                'type' => 'cost'
            ],
            [
                'code' => 'C3',
                'name' => 'Usia',
                'weight' => 3,
                'type' => 'benefit'
            ],
            [
                'code' => 'C4',
                'name' => 'Tanggungan',
                'weight' => 3,
                'type' => 'benefit'
            ],
            [
                'code' => 'C5',
                'name' => 'Kesehatan',
                'weight' => 4,
                'type' => 'cost'
            ],
        ];

        foreach ($examples as $example) {
            Criteria::create($example);
        }
    }
}
