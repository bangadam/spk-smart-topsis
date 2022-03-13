<?php

namespace App\Http\Controllers;

use App\DataTables\CriteriaDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateCriteriaRequest;
use App\Http\Requests\UpdateCriteriaRequest;
use App\Repositories\CriteriaRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class CriteriaController extends AppBaseController
{
    /** @var CriteriaRepository $criteriaRepository*/
    private $criteriaRepository;

    public function __construct(CriteriaRepository $criteriaRepo)
    {
        $this->criteriaRepository = $criteriaRepo;
    }

    /**
     * Display a listing of the Criteria.
     *
     * @param CriteriaDataTable $criteriaDataTable
     *
     * @return Response
     */
    public function index(CriteriaDataTable $criteriaDataTable)
    {
        return $criteriaDataTable->render('criterias.index');
    }

    /**
     * Show the form for creating a new Criteria.
     *
     * @return Response
     */
    public function create()
    {
        return view('criterias.create');
    }

    /**
     * Store a newly created Criteria in storage.
     *
     * @param CreateCriteriaRequest $request
     *
     * @return Response
     */
    public function store(CreateCriteriaRequest $request)
    {
        $input = $request->all();

        $criteria = $this->criteriaRepository->create($input);

        Flash::success('Criteria saved successfully.');

        return redirect(route('criterias.index'));
    }

    /**
     * Display the specified Criteria.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $criteria = $this->criteriaRepository->find($id);

        if (empty($criteria)) {
            Flash::error('Criteria not found');

            return redirect(route('criterias.index'));
        }

        return view('criterias.show')->with('criteria', $criteria);
    }

    /**
     * Show the form for editing the specified Criteria.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $criteria = $this->criteriaRepository->find($id);

        if (empty($criteria)) {
            Flash::error('Criteria not found');

            return redirect(route('criterias.index'));
        }

        return view('criterias.edit')->with('criteria', $criteria);
    }

    /**
     * Update the specified Criteria in storage.
     *
     * @param int $id
     * @param UpdateCriteriaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCriteriaRequest $request)
    {
        $criteria = $this->criteriaRepository->find($id);

        if (empty($criteria)) {
            Flash::error('Criteria not found');

            return redirect(route('criterias.index'));
        }

        $criteria = $this->criteriaRepository->update($request->all(), $id);

        Flash::success('Criteria updated successfully.');

        return redirect(route('criterias.index'));
    }

    /**
     * Remove the specified Criteria from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $criteria = $this->criteriaRepository->find($id);

        if (empty($criteria)) {
            Flash::error('Criteria not found');

            return redirect(route('criterias.index'));
        }

        $this->criteriaRepository->delete($id);

        Flash::success('Criteria deleted successfully.');

        return redirect(route('criterias.index'));
    }
}
