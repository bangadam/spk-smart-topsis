<?php

namespace App\Repositories;

use App\Models\SubCriteria;
use App\Repositories\BaseRepository;

/**
 * Class SubCriteriaRepository
 * @package App\Repositories
 * @version April 12, 2022, 3:57 pm WIB
*/

class SubCriteriaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'weight',
        'criteria_id'
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
        return SubCriteria::class;
    }
}
