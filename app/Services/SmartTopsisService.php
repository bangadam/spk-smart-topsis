<?php

namespace App\Services;

use App\Models\Criteria;
use App\Models\Population;
use App\Models\PopulationAssesment;
use App\Models\SubCriteria;

class SmartTopsisService
{
    /**
     * Prepare data
     */

    // Get all criteria
    public function getCriteriaAll()
    {
        return Criteria::all();
    }

    // Get Total bobot all criteria
    public function getTotalWeightCriteria()
    {
        $criteria = $this->getCriteriaAll();
        $totalWeight = 0;

        foreach ($criteria as $key => $value) {
            $totalWeight += $value->weight;
        }

        return $totalWeight;
    }

    /**
     * get data sample calon penerima bantuan
     *
     * @return array
     */
    public function getDataSamples()
    {
        $data = [];
        $populations = Population::all();

        foreach ($populations as $key => $value) {
            // get population assesment is not process
            $population_assesment = $value->population_assesments()->where('is_process', 0)->first();

            // get population assesment detail
            $population_assesment_detail = $population_assesment->populationAssesmentDetail()->get();

            // add population assesment detail to data
            array_push($data, [
                "population_id" => $value->id,
                "name" => $value->name,
                "population_assesment_id" => $population_assesment->id,
                "population_assesment_detail" => $population_assesment_detail
            ]);
        }

        return $data;
    }

    // get name only from datasample
    public function getNameOnly()
    {
        $data = $this->getDataSamples();
        $name = [];

        foreach ($data as $key => $value) {
            array_push($name, $value['name']);
        }

        return $name;
    }

    /**
     * menghitung benefit
     * @param  integer current Weight
     * @param  array weights
     * @return integer value
     */
    public function getBenefit($current, $weights)
    {
        $min = min($weights);
        $max = max($weights);
        // with precision
        $value = round(($current - $min) / ($max - $min), 3);

        return $value;
    }

    /**
     * menghitung cost
     * @param  integer current Weight
     * @param  array weights
     * @return integer value
     */

    public function getCost($current, $weights)
    {
        $min = min($weights);
        $max = max($weights);

        $value = round(($max-$current) / ($max-$min), 3);
        return $value;
    }

    /**
     * Change vertical value array to horizontal value array
     * @param  array vertical value
     * @return array
     */
    public static function verticalToHorizontal($vertical)
    {
        $horizontal = [];
        $count = count($vertical) - 1;

        foreach (range(0, $count) as $index) {
            // group by key
            $horizontal[$index] = array_column($vertical, $index);
        }

        return $horizontal;
    }

    /**
     * Calculate
     */

    /**
     * Step 1 : Hitung Normalisasi bobot tiap kriteria
     * @param $criteria
     * @param $totalWeight
     * @return array
     */
    public function getNormalizedWeight($criteria)
    {
        $totalWeight = $this->getTotalWeightCriteria();
        $normalizedWeight = [];

        foreach ($criteria as $key => $value) {
            $normalizedWeight[$value->code] = round($value->weight / $totalWeight, 3);
        }

        return $normalizedWeight;
    }

    /**
     * Step 2 : Menentukan nilai utilty tiap alternatif
     * @param $dataset
     * @return array
     */
    public function getUtility($dataset)
    {
        $population_assesment_detail = [];
        foreach ($dataset as $key => $value) {
            array_push($population_assesment_detail, $value['population_assesment_detail']->toArray());
        }
        // get value column separate by row
        $criterias = Criteria::all();
        $column_separate_by_row = [];
        for ($i=0; $i < count($criterias); $i++) {
            array_push($column_separate_by_row, array_column($population_assesment_detail, $i)
            );
        }

        $weights = [];
        $population_assesment_detail2 = [];
        foreach ($dataset as $key => $value) {
            array_push($population_assesment_detail2, $value['population_assesment_detail']->pluck('value')->toArray());
        }
        for ($i=0; $i < count($criterias); $i++) {
            array_push($weights, array_column($population_assesment_detail2, $i)
            );
        }

        // process
        $utility = [];
        foreach ($column_separate_by_row as $key => $value) {
            $utility[$key] = [];
            foreach ($value as $key2 => $value2) {
                $criteria_type = SubCriteria::find($value2['sub_criteria_id'])->criteria->type;

                if ($criteria_type == 'benefit') {
                    $utility[$key][$key2] = $this->getBenefit($value2['value'], $weights[$key]);
                } elseif ($criteria_type == 'cost') {
                    $utility[$key][$key2] = $this->getCost($value2['value'], $weights[$key]);
                }
            }
        }

        return $utility;
    }

    // Step 4 : Mendapatkan Data Sample Calon Penerima Bantuan

    /**
     * Step 5 : Menghitung total nilai hasil akar normalisasi matriks
     * @param $utility
     * @return array
     */
    public function getTotalUtility($utility)
    {
        $totalUtility = [];
        foreach ($utility as $key => $value) {
            $totalUtility[$key] = array_sum($value);
        }

        return $totalUtility;
    }

    // Step 6 : Pembagian hasil akar nilai normalisasi dengan normalisasi matrik
    /**
     * @param utility
     * @param totalUtility
     * @return array
     */
    public function getResultNormalizedRoot($utility, $totalUtility)
    {
        $resultNormalizedRoot = [];
        foreach ($utility as $key => $value) {
            foreach($value as $key2 => $value2) {
                $resultNormalizedRoot[$key][$key2] = round($value2 / $totalUtility[$key], 3);
            }
        }

        return $resultNormalizedRoot;
    }

    // Step 7 : Perhitungan Nilai Hasil Normalisasi Pembobotan
    /**
     * @param resultNormalizedRoot
     * @param normalizedWeight
     * @return array
     */
    public function getResultNormalizedWeight($resultNormalizedRoot, $normalizedWeight)
    {
        $resultNormalizedWeight = [];
        $no = 1;
        foreach ($resultNormalizedRoot as $key => $value) {
            foreach ($value as $key2 => $value2) {
                $resultNormalizedWeight[$key][$key2] = round($value2 * $normalizedWeight['C'.$no], 3);
            }
            $no++;
        }

        return $resultNormalizedWeight;
    }
    //  Step 8 : Menentukan Matriks solusi ideal positif dan solusi ideal negatif
    /**
     * @param resultNormalizedWeight
     * @return array
     */
    public function getResultSolution($resultNormalizedWeight)
    {
        $resultSolution = [];
        // get max and min of sum array
        foreach ($resultNormalizedWeight as $key => $value) {
            $resultSolution[$key]['max'] = max($value);
            $resultSolution[$key]['min'] = min($value);
        }

        return $resultSolution;
    }

    //  Step 9 : Jarak antara nilai setiap alternatif
    /**
     * @param resultSolution
     * @param result_normalized_weight
     * @return array
     */
    public function getResultDistance($resultSolution, $result_normalized_weight)
    {
        $result_normalized_weight = $this->verticalToHorizontal($result_normalized_weight);

        $solutions = [];
        $count = count($resultSolution[0]);
        foreach(range(0, $count-1) as $index) {
            $solutions[$index] = [];
            foreach ($resultSolution as $key => $value) {
                $values = array_values($resultSolution[$key]);

                array_push($solutions[$index], $values[$index]);
            }
        }

        $data_solusi_ideal_positif = [];
        $data_solusi_ideal_negatif = [];
        foreach($result_normalized_weight as $key => $value) {
            $solusi_positif = 0;
            $solusi_negatif = 0;
            // =SQRT((C$84-C70)^2+(D$84-D70)^2+(E$84-E70)^2+(F$84-F70)^2+(G$84-G70)^2)
            foreach($value as $key2 => $value2) {
                $temp1 = $solutions[0][$key2];
                $temp2 = $solutions[1][$key2];

                // positif
                $result1 = pow(($temp1 - $value2), 2);
                $solusi_positif += $result1;

                // negatif
                $result2 = pow(($temp2 - $value2), 2);
                $solusi_negatif += $result2;
            }
            array_push($data_solusi_ideal_positif,sqrt($solusi_positif));
            array_push($data_solusi_ideal_negatif, sqrt($solusi_negatif));
        }

        // get D+ + D-
        $result_distance = [];
        foreach(range(0, count($data_solusi_ideal_positif)-1) as $index) {
            $result_distance[$index] = $data_solusi_ideal_positif[$index] + $data_solusi_ideal_negatif[$index];
        }

        return [
            'solusi_ideal_positif' => $data_solusi_ideal_positif,
            'solusi_ideal_negatif' => $data_solusi_ideal_negatif,
            'distance' => $result_distance
        ];
    }
    // Step 10 : Ranking alternatif
    /**
     * @param result_distance
     * @param alternatif_name
     * @return array
     */
    public function getResultRanking($result_distance, $dataset)
    {
        $nilai_v = [];
        $solusi_negatif = $result_distance['solusi_ideal_negatif'];
        $result_distance = $result_distance['distance'];

        foreach ($solusi_negatif as $key => $value) {
            $nilai_v[$key] = round($value / $result_distance[$key], 8);
        }

        // merge $nilai_v and $alternatif_name
        $result_ranking = [];
        foreach ($nilai_v as $key => $value) {
            $result_ranking[$key] = [
                'nilai_v' => $value,
                'nama_alternatif' => $dataset[$key]['name']
            ];
        }

        // sort desc by nilai_v
        usort($result_ranking, function($a, $b) {
            return $a['nilai_v'] < $b['nilai_v'];
        });

        return $result_ranking;
    }
}
