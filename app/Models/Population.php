<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Population
 * @package App\Models
 * @version March 13, 2022, 7:43 am UTC
 *
 * @property string $card_id_number
 * @property string $name
 * @property string $phone_number
 * @property string $gender
 * @property string $birth_date
 * @property string $address
 * @property integer $village_id
 * @property string $zip_code
 */
class Population extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'populations';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
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
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'card_id_number' => 'string',
        'name' => 'string',
        'phone_number' => 'string',
        'gender' => 'string',
        'birth_date' => 'date',
        'address' => 'string',
        'village_id' => 'integer',
        'zip_code' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'card_id_number' => 'required',
        'name' => 'required',
        'phone_number' => 'required',
        'gender' => 'required',
        'birth_date' => 'required',
        'address' => 'required',
        'village_id' => 'required',
        'zip_code' => 'required'
    ];

    
}
