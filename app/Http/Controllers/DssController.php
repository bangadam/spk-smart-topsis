<?php

namespace App\Http\Controllers;

use App\Models\Period;
use App\Models\PopulationAssesment;
use App\Services\SmartTopsisService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laracasts\Flash\Flash;

class DssController extends Controller
{
    protected $smartTopsisService;

    public function __construct()
    {
        $this->smartTopsisService = new SmartTopsisService();
    }

    public function index(Request $request)
    {
        $data['periods'] = Period::where('status', 'done')->get();
        return view('dss.index', $data);
    }

    public function create(Request $request)
    {
        $data['criterias'] = $this->smartTopsisService->getCriteriaAll();
        $data['total_weight_criteria'] = $this->smartTopsisService->getTotalWeightCriteria();
        $data['normalized_weight_criteria'] = $this->smartTopsisService->getNormalizedWeight($data['criterias']);

        $data['periods'] = Period::where('status', 'ongoing')
            ->orderBy('created_at', 'desc')
            ->get()
            ->pluck('title', 'id');

        return view('dss.create', $data);
    }

    public function next(Request $request)
    {
        $data['criterias'] = $this->smartTopsisService->getCriteriaAll();
        $data['total_weight_criteria'] = $this->smartTopsisService->getTotalWeightCriteria();
        $data['normalized_weight_criteria'] = $this->smartTopsisService->getNormalizedWeight($data['criterias']);
        $data['dataset'] = $this->smartTopsisService->getDataSamples($request);
        $data['alternatif_name'] = $this->smartTopsisService->getNameOnly($request);
        $data['utility'] = $this->smartTopsisService->getUtility($data['dataset']);
        $data['total_utility'] = $this->smartTopsisService->getTotalUtility($data['utility']);
        $data['result_normalized_root'] = $this->smartTopsisService->getResultNormalizedRoot($data['utility'], $data['total_utility']);
        $data['result_normalized_weight'] = $this->smartTopsisService->getResultNormalizedWeight($data['result_normalized_root'], $data['normalized_weight_criteria']);
        $data['result_solution'] = $this->smartTopsisService->getResultSolution($data['result_normalized_weight']);
        $data['result_distance'] = $this->smartTopsisService->getResultDistance($data['result_solution'], $data['result_normalized_weight']);
        $data['result_ranking'] = $this->smartTopsisService->getResultRanking($data['result_distance'], $data['dataset'], $request->period_id);

        $data['periods'] = Period::find($request->period_id);

        return view('dss.create-next', $data);
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $input = $request->all();
            $ranking = json_decode($input['result_ranking'], true);

            foreach ($ranking as $key => $value) {
                $data = json_decode($value['data'], true);
                $population_assesment_model = PopulationAssesment::where('id', $data['population_assesment_id'])->first();
                $population_assesment_model->update([
                    'is_process' => 1,
                    'data' => json_encode($value),
                ]);
            }

            Period::where('id', $request->period_id)->update([
                'status' => 'done',
            ]);

            DB::commit();

            return redirect()->route('dss.index');
        } catch (\Throwable $th) {
            DB::rollback();
            Flash::error('Gagal menyimpan data');
            return redirect()->back();
        }
    }

    public function show($id) {
        $data['population_assesments'] = PopulationAssesment::where('period_id',$id)->get();
        return view('dss.show', $data);
    }
}
