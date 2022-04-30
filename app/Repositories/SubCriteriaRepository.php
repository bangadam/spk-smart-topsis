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

    // create sub criteria
    public function create($request): bool
    {
        try {
            foreach (range(1, $this->model::getMaxSubCriteria()) as $index) {
                $this->model::create([
                    'name' => $request['name'][$index],
                    'weight' => $request['weight'][$index],
                    'criteria_id' => $request['criteria_id'],
                ]);
            }

            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
}
