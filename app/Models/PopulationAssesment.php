<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class PopulationAssesment
 * @package App\Models
 * @version March 13, 2022, 7:43 am UTC
 *
 * @property integer $sub_criteria_id
 * @property integer $population_id
 * @property integer $value
 */
class PopulationAssesment extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'population_assesments';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'sub_criteria_id',
        'population_id',
        'value'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'sub_criteria_id' => 'integer',
        'population_id' => 'integer',
        'value' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'sub_criteria_id' => 'required',
        'population_id' => 'required',
        'value' => 'required'
    ];

    
}
