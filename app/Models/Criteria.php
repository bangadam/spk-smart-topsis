<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Criteria
 * @package App\Models
 * @version April 12, 2022, 3:55 pm WIB
 *
 * @property string $name
 * @property string $weight
 * @property string $type
 */
class Criteria extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'criterias';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'weight',
        'type'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'code' => 'string',
        'name' => 'string',
        'weight' => 'string',
        'type' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'weight' => 'required',
        'type' => 'required'
    ];

    // create criteria form generator
    public static function criteriaFormGenerator()
    {
        $html = '';
        $criterias = Criteria::all();

        foreach ($criterias as $criteria) {
            $html .= '<div class="form-group col-sm-12">';
            $html .= '<label for="' . $criteria->code . '">' . $criteria->name . '</label>';
            $html .= '<select name="' . $criteria->code . '" id="' . $criteria->code . '" class="form-control custom-select">';
            $html .= '<option disabled selected>Pilih Kondisi ' . $criteria->name . '</option>';

            // append sub criteria
            foreach ($criteria->subCriteria as $sub_criteria) {
                $html .= '<option value="' . $sub_criteria->weight . '">' . $sub_criteria->name . '</option>';
            }

            $html .= '</select>';
            $html .= '</div>';
        }

        return $html;
    }

    // get sub criteria
    public function subCriteria()
    {
        return $this->hasMany(SubCriteria::class);
    }
}
