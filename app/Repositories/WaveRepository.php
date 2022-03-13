<?php

namespace App\Repositories;

use App\Models\Wave;
use App\Repositories\BaseRepository;

/**
 * Class WaveRepository
 * @package App\Repositories
 * @version March 13, 2022, 6:35 am UTC
*/

class WaveRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'quota'
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
        return Wave::class;
    }
}
