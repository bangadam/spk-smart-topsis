<?php

namespace App\Repositories;

use App\Models\Surveyor;
use App\Repositories\BaseRepository;

/**
 * Class SurveyorRepository
 * @package App\Repositories
 * @version March 13, 2022, 6:27 am UTC
*/

class SurveyorRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'card_id_number',
        'name',
        'photo',
        'birth_place',
        'birth_date',
        'address',
        'village_id'
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
        return Surveyor::class;
    }
}
