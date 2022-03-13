<?php

namespace App\Http\Controllers;

use App\DataTables\PopulationAssesmentDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatePopulationAssesmentRequest;
use App\Http\Requests\UpdatePopulationAssesmentRequest;
use App\Repositories\PopulationAssesmentRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class PopulationAssesmentController extends AppBaseController
{
    /** @var PopulationAssesmentRepository $populationAssesmentRepository*/
    private $populationAssesmentRepository;

    public function __construct(PopulationAssesmentRepository $populationAssesmentRepo)
    {
        $this->populationAssesmentRepository = $populationAssesmentRepo;
    }

    /**
     * Display a listing of the PopulationAssesment.
     *
     * @param PopulationAssesmentDataTable $populationAssesmentDataTable
     *
     * @return Response
     */
    public function index(PopulationAssesmentDataTable $populationAssesmentDataTable)
    {
        return $populationAssesmentDataTable->render('population_assesments.index');
    }

    /**
     * Show the form for creating a new PopulationAssesment.
     *
     * @return Response
     */
    public function create()
    {
        return view('population_assesments.create');
    }

    /**
     * Store a newly created PopulationAssesment in storage.
     *
     * @param CreatePopulationAssesmentRequest $request
     *
     * @return Response
     */
    public function store(CreatePopulationAssesmentRequest $request)
    {
        $input = $request->all();

        $populationAssesment = $this->populationAssesmentRepository->create($input);

        Flash::success('Population Assesment saved successfully.');

        return redirect(route('populationAssesments.index'));
    }

    /**
     * Display the specified PopulationAssesment.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $populationAssesment = $this->populationAssesmentRepository->find($id);

        if (empty($populationAssesment)) {
            Flash::error('Population Assesment not found');

            return redirect(route('populationAssesments.index'));
        }

        return view('population_assesments.show')->with('populationAssesment', $populationAssesment);
    }

    /**
     * Show the form for editing the specified PopulationAssesment.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $populationAssesment = $this->populationAssesmentRepository->find($id);

        if (empty($populationAssesment)) {
            Flash::error('Population Assesment not found');

            return redirect(route('populationAssesments.index'));
        }

        return view('population_assesments.edit')->with('populationAssesment', $populationAssesment);
    }

    /**
     * Update the specified PopulationAssesment in storage.
     *
     * @param int $id
     * @param UpdatePopulationAssesmentRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePopulationAssesmentRequest $request)
    {
        $populationAssesment = $this->populationAssesmentRepository->find($id);

        if (empty($populationAssesment)) {
            Flash::error('Population Assesment not found');

            return redirect(route('populationAssesments.index'));
        }

        $populationAssesment = $this->populationAssesmentRepository->update($request->all(), $id);

        Flash::success('Population Assesment updated successfully.');

        return redirect(route('populationAssesments.index'));
    }

    /**
     * Remove the specified PopulationAssesment from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $populationAssesment = $this->populationAssesmentRepository->find($id);

        if (empty($populationAssesment)) {
            Flash::error('Population Assesment not found');

            return redirect(route('populationAssesments.index'));
        }

        $this->populationAssesmentRepository->delete($id);

        Flash::success('Population Assesment deleted successfully.');

        return redirect(route('populationAssesments.index'));
    }
}
