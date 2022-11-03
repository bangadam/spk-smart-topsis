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

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'periode' => 'required',
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
        foreach ($data['population_assesment_detail'] as $item) {
            $criteria_name = SubCriteria::find($item['sub_criteria_id'])->criteria->name;
            $sub_criteria_name = SubCriteria::find($item['sub_criteria_id'])->name;
            // make key value
            $temp[$criteria_name] = $sub_criteria_name;
        }

        return $temp;
    }

    public static function getTotalReceived(): int
    {
        $total = 0;
        $populationAssesments = PopulationAssesment::all();
        foreach ($populationAssesments as $item) {
            if ($item->data != null) {
                $data = json_decode($item->data, true);
                if (strtolower($data['status']) == "layak") {
                    $total++;
                }
            }
        }

        return $total;
    }

    public function getRankingList($id_period)
    {
        $data = $this->where('period_id', $id_period)->get();

        // sort by ranking in data
        $data = $data->sortBy(function ($item) {
            $data = json_decode($item->data, true);
            return $data['ranking'];
        });

        return $data;
    }

    public function scopeCreateData(Population $population, PopulationAssesment $assessment)
    {
        $data = [];
        $data["data"] = null;
        $data["status"] = null;
        $data["nilai_v"] = null;
        $data["ranking"] = null;
        $data["nama_alternatif"] = $population->name;

        $temp_data = [
            "population_id" => $population->id,
            "name" => $population->name,
            "population_assesment_id" => $this->id,
        ];

        $temp_population_assesment_detail = [];
        foreach ($assessment->populationAssesmentDetail as $item) {
            array_push($temp_population_assesment_detail, [
                "id" => $item->id,
                "population_assesment_id" => $item->population_assesment_id,
                "sub_criteria_id" => $item->sub_criteria_id,
                "value" => $item->value,
                "created_at" => $item->created_at,
                "updated_at" => $item->updated_at,
                "deleted_at" => $item->deleted_at,
            ]);
        }
    }
}
