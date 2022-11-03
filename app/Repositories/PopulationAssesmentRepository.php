<?php

namespace App\Repositories;

use App\Models\Period;
use App\Models\Population;
use App\Models\PopulationAssesment;
use App\Models\SubCriteria;
use App\Repositories\BaseRepository;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class PopulationAssesmentRepository
 * @package App\Repositories
 * @version March 13, 2022, 7:43 am UTC
 */

class PopulationAssesmentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'sub_criteria_id',
        'population_id',
        'value'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PopulationAssesment::class;
    }

    public function duplicate($population_id)
    {
        DB::beginTransaction();
        try {
            $population = Population::find($population_id);

            // check periode aktif
            $periode = Period::where('status', 'ongoing')->first();

            if (empty($periode)) {
                throw new Exception("Periode baru belum ada");
            }

            // get last population assesment with population assesment detail
            $lastPopulationAssesment = PopulationAssesment::with('populationAssesmentDetail')->where('population_id', $population_id)->orderBy('id', 'desc')->first();

            // create population assesment
            $populationAssesmnet = $population->population_assesments()->create([
                'date' => now(),
                'is_process' => false,
                'period_id' => $periode->id
            ]);

            foreach ($lastPopulationAssesment->populationAssesmentDetail as $key => $item) {
                $sub_criteria = SubCriteria::find($item->sub_criteria_id);

                if (empty($sub_criteria)) {
                    throw new Exception("Sub Kriteria tidak ditemukan");
                }

                $populationAssesmnet->populationAssesmentDetail()->create([
                    'sub_criteria_id' => $sub_criteria->id,
                    'value' => $sub_criteria->weight,
                ]);
            }

            DB::commit();
            return $population;
        } catch (\Exception $th) {
            DB::rollback();
            throw $th;
        }
    }
}
