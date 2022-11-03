<?php

namespace Database\Seeders;

use App\Models\Criteria;
use App\Models\SubCriteria;
use Illuminate\Database\Seeder;

class SubCriteriaSeeder extends Seeder
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
                [
                    'name' => 'PHK / Ibu Rumah Tangga',
                    'weight' => 1,
                ],
                [
                    'name' => 'Buruh',
                    'weight' => 2,
                ],
                [
                    'name' => 'Pedagang',
                    'weight' => 3,
                ],
                [
                    'name' => 'Petani',
                    'weight' => 4,
                ],
                [
                    'name' => 'Pegawai BUMN',
                    'weight' => 5,
                ],
            ],
            [
                [
                    'name' => '> 5.000.000',
                    'weight' => 5,
                    'min' => 5000000,
                ],
                [
                    'name' => '3.100.000 - 5.000.000',
                    'weight' => 4,
                    'min' => 3100000,
                    'max' => 5000000,
                ],
                [
                    'name' => '1.100.000 - 3.000.000',
                    'weight' => 3,
                    'min' => 1100000,
                    'max' => 3000000,
                ],
                [
                    'name' => '500.000 - 1.000.000',
                    'weight' => 2,
                    'min' => 500000,
                    'max' => 1000000,
                ],
                [
                    'name' => '< 500.000',
                    'weight' => 1,
                    'max' => 500000,
                ],
            ],
            [
                [
                    'name' => '17 - 25',
                    'weight' => 1,
                    'min' => 17,
                    'max' => 25,
                ],
                [
                    'name' => '26 - 35',
                    'weight' => 2,
                    'min' => 26,
                    'max' => 35,
                ],
                [
                    'name' => '36 - 45',
                    'weight' => 3,
                    'min' => 36,
                    'max' => 45,
                ],
                [
                    'name' => '46 - 55',
                    'weight' => 4,
                    'min' => 46,
                    'max' => 55,
                ],
                [
                    'name' => '> 55',
                    'weight' => 5,
                    'min' => 55,
                ],
            ],
            [
                [
                    'name' => '1',
                    'weight' => 1,
                ],
                [
                    'name' => '2',
                    'weight' => 2,
                ],
                [
                    'name' => '3',
                    'weight' => 3,
                ],
                [
                    'name' => '4',
                    'weight' => 4,
                ],
                [
                    'name' => '> 5',
                    'weight' => 5,
                ],
            ],
            [
                [
                    'name' => 'Memiliki asuransi kesehatan biaya pribadi',
                    'weight' => 4,
                ],
                [
                    'name' => 'Memiliki asuransi kesehatan biaya pemerintah',
                    'weight' => 3,
                ],
                [
                    'name' => 'Memiliki KTP sesuai daerah domisili, tidak memiliki asuransi',
                    'weight' => 2,
                ],
                [
                    'name' => 'Tidak memiliki KTP sesuai daerah domisili dan tidak memiliki asuransi',
                    'weight' => 1,
                ],
            ],
        ];

        $number = 1;
        foreach ($examples as $key => $example) {
            foreach ($example as $no => $sub) {
                SubCriteria::create([
                    'criteria_id' => $key + 1,
                    'code' => 'SC' . $number++,
                    'name' => $sub['name'],
                    'weight' => $sub['weight'],
                    'min' => $sub['min'] ?? null,
                    'max' => $sub['max'] ?? null,
                ]);
            }
        }
    }
}
