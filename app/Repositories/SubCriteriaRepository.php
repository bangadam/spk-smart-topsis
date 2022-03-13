<?php

namespace App\Repositories;

use App\Models\SubCriteria;
use App\Repositories\BaseRepository;

/**
 * Class SubCriteriaRepository
 * @package App\Repositories
 * @version March 13, 2022, 4:17 am UTC
*/

class SubCriteriaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'weight',
        'type'
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
