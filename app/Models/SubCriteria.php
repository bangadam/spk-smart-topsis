<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class SubCriteria
 * @package App\Models
 * @version April 2, 2022, 2:41 pm UTC
 *
 * @property string $name
 * @property integer $weight
 * @property integer $criteria_id
 */
class SubCriteria extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'sub_criterias';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'weight',
        'criteria_id'
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
        'weight' => 'integer',
        'criteria_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'weight' => 'required',
        'criteria_id' => 'required'
    ];

    
}
