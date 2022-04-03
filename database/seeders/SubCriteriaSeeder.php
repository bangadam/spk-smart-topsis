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
                    'name' => 'Guru',
                    'weight' => 20,
                ],
                [
                    'name' => 'Karyawan',
                    'weight' => 40,
                ],
                [
                    'name' => 'Petani',
                    'weight' => 60,
                ],
                [
                    'name' => 'Pedagang Keliling',
                    'weight' => 80,
                ],
                [
                    'name' => 'PHK',
                    'weight' => 100,
                ],
            ],
            [
                [
                    'name' => '> 5.100.000',
                    'weight' => 20,
                ],
                [
                    'name' => '3.100.000 - 5.000.000',
                    'weight' => 40,
                ],
                [
                    'name' => '1.100.000 - 3.000.000',
                    'weight' => 60,
                ],
                [
                    'name' => '500.000 - 1.000.000',
                    'weight' => 80,
                ],
                [
                    'name' => '< 500.000',
                    'weight' => 100,
                ],
            ],
            [
                [
                    'name' => '17 - 25',
                    'weight' => 20,
                ],
                [
                    'name' => '26 - 35',
                    'weight' => 40,
                ],
                [
                    'name' => '36 - 45',
                    'weight' => 60,
                ],
                [
                    'name' => '46 - 55',
                    'weight' => 80,
                ],
                [
                    'name' => '> 61',
                    'weight' => 100,
                ],
            ],
            [
                [
                    'name' => '< 2',
                    'weight' => 20,
                ],
                [
                    'name' => '2',
                    'weight' => 40,
                ],
                [
                    'name' => '3',
                    'weight' => 60,
                ],
                [
                    'name' => '4',
                    'weight' => 80,
                ],
                [
                    'name' => '> 5',
                    'weight' => 100,
                ],
            ],
            [
                [
                    'name' => 'tidak terjangkit',
                    'weight' => 20,
                ],
                [
                    'name' => 'Orang Tanpa Gejala',
                    'weight' => 40,
                ],
                [
                    'name' => 'Orang Dalam Pemantauan',
                    'weight' => 60,
                ],
                [
                    'name' => 'Pasien Dalam Pengawasan',
                    'weight' => 80,
                ],
                [
                    'name' => ' Positif Terjangkit',
                    'weight' => 100,
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
                ]);
            }
        }
    }
}
