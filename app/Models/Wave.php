<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Wave
 * @package App\Models
 * @version March 13, 2022, 6:35 am UTC
 *
 * @property string $name
 * @property integer $quota
 */
class Wave extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'waves';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'quota'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'quota' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'quota' => 'required'
    ];

    
}
