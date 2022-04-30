<?php

namespace App\Repositories;

use App\Models\Period;
use App\Repositories\BaseRepository;

/**
 * Class PeriodRepository
 * @package App\Repositories
 * @version April 28, 2022, 2:24 pm WIB
*/

class PeriodRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'quota',
        'start_date',
        'end_date',
        'status'
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
        return Period::class;
    }
}
