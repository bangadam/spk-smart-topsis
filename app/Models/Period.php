<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Period
 * @package App\Models
 * @version April 28, 2022, 2:24 pm WIB
 *
 * @property string $title
 * @property integer $quota
 * @property string $start_date
 * @property string $end_date
 * @property string $status
 */
class Period extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'periods';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'title',
        'quota',
        'start_date',
        'end_date',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'quota' => 'integer',
        'start_date' => 'date',
        'end_date' => 'date',
        'status' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required',
        'quota' => 'required',
        'start_date' => 'required',
        'end_date' => 'required',
        'status' => 'required'
    ];

    /**
     * Status
     */
    const STATUS = [
        'done' => 'Selesai',
        'ongoing' => 'Sedang Berlangsung',
        'closed' => 'Ditutup'
    ];

    /**
     * Get All Status
     * @return array
     */
    public static function getStatus()
    {
        return self::STATUS;
    }
}
