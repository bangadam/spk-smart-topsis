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
        'data'
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

    // parse data to array
    public function parseData()
    {
        $data = json_decode($this->data, true);
        $data['data'] = $this->parseChildData($data['data']);
        return $data;
    }

    private function parseChildData($data)
    {
        $data = json_decode($data, true);
        $temp = [];
        // get population assesment detail
        foreach($data['population_assesment_detail'] as $item)
        {
            $criteria_name = SubCriteria::find($item['sub_criteria_id'])->criteria->name;
            $sub_criteria_name = SubCriteria::find($item['sub_criteria_id'])->name;
            // make key value
            $temp[$criteria_name] =$sub_criteria_name;
        }

        return $temp;
    }
}
