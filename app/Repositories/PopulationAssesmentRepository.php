<?php

namespace App\Repositories;

use App\Models\PopulationAssesment;
use App\Repositories\BaseRepository;

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
}
