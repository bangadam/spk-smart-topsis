<?php

namespace App\Repositories;

use App\Models\Receiver;
use App\Repositories\BaseRepository;

/**
 * Class ReceiverRepository
 * @package App\Repositories
 * @version March 13, 2022, 8:16 am UTC
*/

class ReceiverRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        
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
        return Receiver::class;
    }
}
