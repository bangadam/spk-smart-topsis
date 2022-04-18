<?php

namespace App\Repositories;

use App\Models\Population;
use App\Repositories\BaseRepository;

/**
 * Class PopulationRepository
 * @package App\Repositories
 * @version April 12, 2022, 4:01 pm WIB
*/

class PopulationRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'card_id_number',
        'name',
        'phone_number',
        'gender',
        'birth_date',
        'address',
        'village_id',
        'zip_code'
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
        return Population::class;
    }
}
