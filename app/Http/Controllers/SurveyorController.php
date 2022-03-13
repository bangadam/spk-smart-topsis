<?php

namespace App\Http\Controllers;

use App\DataTables\SurveyorDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateSurveyorRequest;
use App\Http\Requests\UpdateSurveyorRequest;
use App\Repositories\SurveyorRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class SurveyorController extends AppBaseController
{
    /** @var SurveyorRepository $surveyorRepository*/
    private $surveyorRepository;

    public function __construct(SurveyorRepository $surveyorRepo)
    {
        $this->surveyorRepository = $surveyorRepo;
    }

    /**
     * Display a listing of the Surveyor.
     *
     * @param SurveyorDataTable $surveyorDataTable
     *
     * @return Response
     */
    public function index(SurveyorDataTable $surveyorDataTable)
    {
        return $surveyorDataTable->render('surveyors.index');
    }

    /**
     * Show the form for creating a new Surveyor.
     *
     * @return Response
     */
    public function create()
    {
        return view('surveyors.create');
    }

    /**
     * Store a newly created Surveyor in storage.
     *
     * @param CreateSurveyorRequest $request
     *
     * @return Response
     */
    public function store(CreateSurveyorRequest $request)
    {
        $input = $request->all();

        $surveyor = $this->surveyorRepository->create($input);

        Flash::success('Surveyor saved successfully.');

        return redirect(route('surveyors.index'));
    }

    /**
     * Display the specified Surveyor.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $surveyor = $this->surveyorRepository->find($id);

        if (empty($surveyor)) {
            Flash::error('Surveyor not found');

            return redirect(route('surveyors.index'));
        }

        return view('surveyors.show')->with('surveyor', $surveyor);
    }

    /**
     * Show the form for editing the specified Surveyor.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $surveyor = $this->surveyorRepository->find($id);

        if (empty($surveyor)) {
            Flash::error('Surveyor not found');

            return redirect(route('surveyors.index'));
        }

        return view('surveyors.edit')->with('surveyor', $surveyor);
    }

    /**
     * Update the specified Surveyor in storage.
     *
     * @param int $id
     * @param UpdateSurveyorRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSurveyorRequest $request)
    {
        $surveyor = $this->surveyorRepository->find($id);

        if (empty($surveyor)) {
            Flash::error('Surveyor not found');

            return redirect(route('surveyors.index'));
        }

        $surveyor = $this->surveyorRepository->update($request->all(), $id);

        Flash::success('Surveyor updated successfully.');

        return redirect(route('surveyors.index'));
    }

    /**
     * Remove the specified Surveyor from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $surveyor = $this->surveyorRepository->find($id);

        if (empty($surveyor)) {
            Flash::error('Surveyor not found');

            return redirect(route('surveyors.index'));
        }

        $this->surveyorRepository->delete($id);

        Flash::success('Surveyor deleted successfully.');

        return redirect(route('surveyors.index'));
    }
}
