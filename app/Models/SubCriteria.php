<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class SubCriteria
 * @package App\Models
 * @version March 13, 2022, 4:17 am UTC
 *
 * @property string $name
 * @property string $weight
 * @property string $type
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

    
}
