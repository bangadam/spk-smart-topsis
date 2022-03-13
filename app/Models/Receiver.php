<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Receiver
 * @package App\Models
 * @version March 13, 2022, 8:16 am UTC
 *
 */
class Receiver extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'receivers';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'population_assesment_id' => 'integer',
        'total_value' => 'string',
        'wave_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'wave_id' => 'required'
    ];

    
}
