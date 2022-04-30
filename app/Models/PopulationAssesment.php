<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PopulationAssesment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'population_id',
        'date',
        'is_process',
        'period_id',
    ];

    // population_assesment_detail
    public function populationAssesmentDetail()
    {
        return $this->hasMany(PopulationAssesmentDetail::class);
    }

    // population
    public function population()
    {
        return $this->belongsTo(Population::class);
    }
}
