<?php

namespace App\Http\Controllers;

use App\Models\Population;
use App\Models\PopulationAssesment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RiwayatDataController extends Controller
{
    public function index(Request $request) {
        try {
            $population = Population::where('user_id', auth()->user()->id)->first();
            $data['riwayat_data'] = PopulationAssesment::where([
                'population_id' => $population->id,
                "is_process" => true,
            ])->orderBy('date', 'desc')->get();
            return view('riwayat.index', $data);
        } catch (\Throwable $th) {
            Log::emergency("message" . $th->getMessage() . " line" . $th->getLine());
            return redirect()->back()->with('error', 'Terjadi kesalahan pada sistem');
        }
    }
}
