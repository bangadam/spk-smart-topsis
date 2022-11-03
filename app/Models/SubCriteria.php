<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class SubCriteria
 * @package App\Models
 * @version April 12, 2022, 3:57 pm WIB
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

    const MAX_SUBCRITEIA = 5;

    public $fillable = [
        'name',
        'weight',
        'criteria_id',
        "min",
        'max',
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

    public static $weights = [
        20 => '20',
        40 => '40',
        60 => '60',
        80 => '80',
        100 => '100',
    ];

    public function criteria()
    {
        return $this->belongsTo(Criteria::class);
    }

    // get max sub criteria
    public static function getMaxSubCriteria()
    {
        return self::MAX_SUBCRITEIA;
    }

    // get weights
    public static function getWeights()
    {
        return self::$weights;
    }

    // generate code on create
    public static function boot()
    {
        parent::boot();

        self::creating(function($model){
            $last = self::count();
            $model->code = 'SC' . ($last + 1);
        });
    }
}
