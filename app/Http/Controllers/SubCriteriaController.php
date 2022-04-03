<?php

namespace App\Http\Controllers;

use App\DataTables\SubCriteriaDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateSubCriteriaRequest;
use App\Http\Requests\UpdateSubCriteriaRequest;
use App\Repositories\SubCriteriaRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class SubCriteriaController extends AppBaseController
{
    /** @var SubCriteriaRepository $subCriteriaRepository*/
    private $subCriteriaRepository;

    public function __construct(SubCriteriaRepository $subCriteriaRepo)
    {
        $this->subCriteriaRepository = $subCriteriaRepo;
    }

    /**
     * Display a listing of the SubCriteria.
     *
     * @param SubCriteriaDataTable $subCriteriaDataTable
     *
     * @return Response
     */
    public function index(SubCriteriaDataTable $subCriteriaDataTable)
    {
        return $subCriteriaDataTable->render('sub_criterias.index');
    }

    /**
     * Show the form for creating a new SubCriteria.
     *
     * @return Response
     */
    public function create()
    {
        return view('sub_criterias.create');
    }

    /**
     * Store a newly created SubCriteria in storage.
     *
     * @param CreateSubCriteriaRequest $request
     *
     * @return Response
     */
    public function store(CreateSubCriteriaRequest $request)
    {
        $input = $request->all();

        $subCriteria = $this->subCriteriaRepository->create($input);

        Flash::success('Sub Criteria saved successfully.');

        return redirect(route('subCriterias.index'));
    }

    /**
     * Display the specified SubCriteria.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $subCriteria = $this->subCriteriaRepository->find($id);

        if (empty($subCriteria)) {
            Flash::error('Sub Criteria not found');

            return redirect(route('subCriterias.index'));
        }

        return view('sub_criterias.show')->with('subCriteria', $subCriteria);
    }

    /**
     * Show the form for editing the specified SubCriteria.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $subCriteria = $this->subCriteriaRepository->find($id);

        if (empty($subCriteria)) {
            Flash::error('Sub Criteria not found');

            return redirect(route('subCriterias.index'));
        }

        return view('sub_criterias.edit')->with('subCriteria', $subCriteria);
    }

    /**
     * Update the specified SubCriteria in storage.
     *
     * @param int $id
     * @param UpdateSubCriteriaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSubCriteriaRequest $request)
    {
        $subCriteria = $this->subCriteriaRepository->find($id);

        if (empty($subCriteria)) {
            Flash::error('Sub Criteria not found');

            return redirect(route('subCriterias.index'));
        }

        $subCriteria = $this->subCriteriaRepository->update($request->all(), $id);

        Flash::success('Sub Criteria updated successfully.');

        return redirect(route('subCriterias.index'));
    }

    /**
     * Remove the specified SubCriteria from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $subCriteria = $this->subCriteriaRepository->find($id);

        if (empty($subCriteria)) {
            Flash::error('Sub Criteria not found');

            return redirect(route('subCriterias.index'));
        }

        $this->subCriteriaRepository->delete($id);

        Flash::success('Sub Criteria deleted successfully.');

        return redirect(route('subCriterias.index'));
    }
}
