<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Surveyor
 * @package App\Models
 * @version March 13, 2022, 6:27 am UTC
 *
 * @property string $card_id_number
 * @property string $name
 * @property string $photo
 * @property string $birth_place
 * @property string $birth_date
 * @property string $address
 * @property integer $village_id
 */
class Surveyor extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'surveyors';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'card_id_number',
        'name',
        'photo',
        'birth_place',
        'birth_date',
        'address',
        'village_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'card_id_number' => 'string',
        'name' => 'string',
        'photo' => 'string',
        'birth_place' => 'string',
        'birth_date' => 'date',
        'address' => 'string',
        'village_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'card_id_number' => 'required',
        'name' => 'required',
        'photo' => 'required',
        'birth_place' => 'required',
        'birth_date' => 'required',
        'address' => 'required',
        'village_id' => 'required'
    ];

    
}
