<?php

namespace App\Http\Controllers;

use App\DataTables\PeriodDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatePeriodRequest;
use App\Http\Requests\UpdatePeriodRequest;
use App\Repositories\PeriodRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class PeriodController extends AppBaseController
{
    /** @var PeriodRepository $periodRepository*/
    private $periodRepository;

    public function __construct(PeriodRepository $periodRepo)
    {
        $this->periodRepository = $periodRepo;
    }

    /**
     * Display a listing of the Period.
     *
     * @param PeriodDataTable $periodDataTable
     *
     * @return Response
     */
    public function index(PeriodDataTable $periodDataTable)
    {
        return $periodDataTable->render('periods.index');
    }

    /**
     * Show the form for creating a new Period.
     *
     * @return Response
     */
    public function create()
    {
        return view('periods.create');
    }

    /**
     * Store a newly created Period in storage.
     *
     * @param CreatePeriodRequest $request
     *
     * @return Response
     */
    public function store(CreatePeriodRequest $request)
    {
        $input = $request->all();

        $period = $this->periodRepository->create($input);

        Flash::success('Period saved successfully.');

        return redirect(route('periods.index'));
    }

    /**
     * Display the specified Period.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $period = $this->periodRepository->find($id);

        if (empty($period)) {
            Flash::error('Period not found');

            return redirect(route('periods.index'));
        }

        return view('periods.show')->with('period', $period);
    }

    /**
     * Show the form for editing the specified Period.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $period = $this->periodRepository->find($id);

        if (empty($period)) {
            Flash::error('Period not found');

            return redirect(route('periods.index'));
        }

        return view('periods.edit')->with('period', $period);
    }

    /**
     * Update the specified Period in storage.
     *
     * @param int $id
     * @param UpdatePeriodRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePeriodRequest $request)
    {
        $period = $this->periodRepository->find($id);

        if (empty($period)) {
            Flash::error('Period not found');

            return redirect(route('periods.index'));
        }

        $period = $this->periodRepository->update($request->all(), $id);

        Flash::success('Period updated successfully.');

        return redirect(route('periods.index'));
    }

    /**
     * Remove the specified Period from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $period = $this->periodRepository->find($id);

        if (empty($period)) {
            Flash::error('Period not found');

            return redirect(route('periods.index'));
        }

        $this->periodRepository->delete($id);

        Flash::success('Period deleted successfully.');

        return redirect(route('periods.index'));
    }
}
