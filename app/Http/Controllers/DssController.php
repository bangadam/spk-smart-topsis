<?php

namespace App\Http\Controllers;

use App\Services\SmartTopsisService;
use Illuminate\Http\Request;

class DssController extends Controller
{
    protected $smartTopsisService;

    public function __construct()
    {
        $this->smartTopsisService = new SmartTopsisService();
    }

    public function index(Request $request)
    {
        return view('dss.index');
    }

    public function create(Request $request)
    {
        $data['criterias'] = $this->smartTopsisService->getCriteriaAll();
        $data['total_weight_criteria'] = $this->smartTopsisService->getTotalWeightCriteria();
        $data['normalized_weight_criteria'] = $this->smartTopsisService->getNormalizedWeight($data['criterias']);
        $data['dataset'] = $this->smartTopsisService->getDataSamples();
        $data['alternatif_name'] = $this->smartTopsisService->getNameOnly();
        $data['utility'] = $this->smartTopsisService->getUtility($data['dataset']);
        $data['total_utility'] = $this->smartTopsisService->getTotalUtility($data['utility']);
        $data['result_normalized_root'] = $this->smartTopsisService->getResultNormalizedRoot($data['utility'], $data['total_utility']);
        $data['result_normalized_weight'] = $this->smartTopsisService->getResultNormalizedWeight($data['result_normalized_root'], $data['normalized_weight_criteria']);
        $data['result_solution'] = $this->smartTopsisService->getResultSolution($data['result_normalized_weight']);
        $data['result_distance'] = $this->smartTopsisService->getResultDistance($data['result_solution'], $data['result_normalized_weight']);
        $data['result_ranking'] = $this->smartTopsisService->getResultRanking($data['result_distance'], $data['dataset']);

        return view('dss.create', $data);
    }

    public function store(Request $request)
    {

    }
}
