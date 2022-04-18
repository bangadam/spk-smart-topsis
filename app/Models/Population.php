<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Population
 * @package App\Models
 * @version April 12, 2022, 4:01 pm WIB
 *
 * @property string $card_id_number
 * @property string $family_card_id
 * @property string $name
 * @property string $phone_number
 * @property string $gender
 * @property string $birth_date
 * @property string $address
 * @property integer $village_id
 * @property string $zip_code
 * @property integer $created_by
 */
class Population extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'populations';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id',
        'card_id_number',
        'family_card_id',
        'name',
        'phone_number',
        'gender',
        'birth_date',
        'address',
        'village_id',
        'zip_code',
        'created_by'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'card_id_number' => 'string',
        'family_card_id' => 'string',
        'name' => 'string',
        'phone_number' => 'string',
        'gender' => 'string',
        'birth_date' => 'date',
        'address' => 'string',
        'village_id' => 'integer',
        'zip_code' => 'string',
        'created_by' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'card_id_number' => 'required|unique:populations',
        'family_card_id' => 'required',
        'name' => 'required',
        'phone_number' => 'required',
        'gender' => 'required',
        'birth_date' => 'required',
        'address' => 'required',
        'village_id' => 'required',
        'zip_code' => 'required'
    ];


    const GENDER = [
        'male' => "Pria",
        "female" => 'Wanita'
    ];

    // get gender
    public static function getGenderList()
    {
        return self::GENDER;
    }

    // population assesment
    public function population_assesments()
    {
        return $this->hasMany(PopulationAssesment::class);
    }
}
