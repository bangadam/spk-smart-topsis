<?php

namespace App\Http\Controllers;

use App\DataTables\PopulationDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatePopulationRequest;
use App\Http\Requests\UpdatePopulationRequest;
use App\Repositories\PopulationRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use App\Imports\PopulationAssesmentImport;
use App\Models\Criteria;
use App\Models\Population;
use App\Models\User;
use App\Repositories\PopulationAssesmentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Response;

class PopulationController extends AppBaseController
{
    /** @var PopulationRepository $populationRepository*/
    private $populationRepository;
    private $populationAssesmentRepository;

    public function __construct(PopulationRepository $populationRepo, PopulationAssesmentRepository $populationAssesmentRepo)
    {
        $this->populationRepository = $populationRepo;
        $this->populationAssesmentRepository = $populationAssesmentRepo;
    }

    /**
     * Display a listing of the Population.
     *
     * @param PopulationDataTable $populationDataTable
     *
     * @return Response
     */
    public function index(PopulationDataTable $populationDataTable)
    {
        return $populationDataTable->render('populations.index');
    }

    /**
     * Show the form for creating a new Population.
     *
     * @return Response
     */
    public function create()
    {
        $data['gender'] = Population::getGenderList();
        $data['provinces'] = \Indonesia::allProvinces()->pluck('name', 'id');

        return view('populations.create', $data);
    }

    /**
     * Store a newly created Population in storage.
     *
     * @param CreatePopulationRequest $request
     *
     * @return Response
     */
    public function store(CreatePopulationRequest $request)
    {
        try {
            DB::beginTransaction();

            $input = $request->all();

            // create user population
            $user = User::createFromPopulation($input);

            $input['user_id'] = $user->id;
            $input['created_by'] = auth()->user()->id;

            $population = $this->populationRepository->create($input);

            // create population assesment
            $population_assesment = $population->population_assesments()->create([
                'date' => now(),
                'created_by' => auth()->user()->id,
            ]);

            // create population assessment detail
            $criterias = Criteria::all();

            foreach ($criterias as $key => $criteria) {
                ++$key;
                $population_assesment_detail = $population_assesment->populationAssesmentDetail()->create([
                    'criteria_id' => $criteria->id,
                    'value' => $input['C' . $key],
                    'created_by' => auth()->user()->id,
                ]);
            }

            Flash::success('Berhasil menyimpan data');
            DB::commit();

            return redirect(route('populations.index'));
        } catch (\Throwable $th) {
            DB::rollback();
            Flash::error('Gagal menyimpan data');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified Population.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $population = $this->populationRepository->find($id);

        if (empty($population)) {
            Flash::error('Population not found');

            return redirect(route('populations.index'));
        }

        return view('populations.show')->with('population', $population);
    }

    /**
     * Show the form for editing the specified Population.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $population = $this->populationRepository->find($id)->load('population_assesments.populationAssesmentDetail');

        if (empty($population)) {
            Flash::error('Population not found');

            return redirect(route('populations.index'));
        }

        $data['gender'] = Population::getGenderList();
        $data['provinces'] = \Indonesia::allProvinces()->pluck('name', 'id')->toArray();
        $data['cities'] = \Indonesia::allCities()->pluck('name', 'id')->toArray();
        $data['districts'] = \Indonesia::allDistricts()->pluck('name', 'id')->toArray();
        $data['villages'] = \Indonesia::allVillages()->pluck('name', 'id')->toArray();

        $data['population'] = $population;
        $data['gender'] = Population::getGenderList();
        return view('populations.edit', $data);
    }

    /**
     * Update the specified Population in storage.
     *
     * @param int $id
     * @param UpdatePopulationRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePopulationRequest $request)
    {
        $population = $this->populationRepository->find($id);

        if (empty($population)) {
            Flash::error('Population not found');

            return redirect(route('populations.index'));
        }

        $population = $this->populationRepository->update($request->all(), $id);

        Flash::success('Population updated successfully.');

        return redirect(route('populations.index'));
    }

    /**
     * Remove the specified Population from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $population = $this->populationRepository->find($id);

        if (empty($population)) {
            Flash::error('Population not found');

            return redirect(route('populations.index'));
        }

        $this->populationRepository->delete($id);

        Flash::success('Population deleted successfully.');

        return redirect(route('populations.index'));
    }

    public function import(Request $request)
    {
        try {
            if ($request->hasFile('file')) {
                $file = $request->file('file');

                Excel::queueImport(new PopulationAssesmentImport, $file);

                Flash::success('Berhasil mengimport data');
                return redirect(route('populations.index'));
            }

            Flash::error('File tidak boleh kosong');
            return redirect()->back();
        } catch (\Throwable $th) {
            dd($th);
            Flash::error('Gagal mengimport data');
            return redirect()->back();
        }
    }

    public function duplicate($id)
    {
        try {
            $result = $this->populationAssesmentRepository->duplicate($id);
            Flash::success("Berhasil menduplikasi data $result->name");
            return redirect()->back();
        } catch (\Throwable $th) {
            dd($th);
            Flash::error('Gagal menyimpan data');
            return redirect()->back();
        }
    }
}
