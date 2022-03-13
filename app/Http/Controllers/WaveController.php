<?php

namespace App\Http\Controllers;

use App\DataTables\WaveDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateWaveRequest;
use App\Http\Requests\UpdateWaveRequest;
use App\Repositories\WaveRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class WaveController extends AppBaseController
{
    /** @var WaveRepository $waveRepository*/
    private $waveRepository;

    public function __construct(WaveRepository $waveRepo)
    {
        $this->waveRepository = $waveRepo;
    }

    /**
     * Display a listing of the Wave.
     *
     * @param WaveDataTable $waveDataTable
     *
     * @return Response
     */
    public function index(WaveDataTable $waveDataTable)
    {
        return $waveDataTable->render('waves.index');
    }

    /**
     * Show the form for creating a new Wave.
     *
     * @return Response
     */
    public function create()
    {
        return view('waves.create');
    }

    /**
     * Store a newly created Wave in storage.
     *
     * @param CreateWaveRequest $request
     *
     * @return Response
     */
    public function store(CreateWaveRequest $request)
    {
        $input = $request->all();

        $wave = $this->waveRepository->create($input);

        Flash::success('Wave saved successfully.');

        return redirect(route('waves.index'));
    }

    /**
     * Display the specified Wave.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $wave = $this->waveRepository->find($id);

        if (empty($wave)) {
            Flash::error('Wave not found');

            return redirect(route('waves.index'));
        }

        return view('waves.show')->with('wave', $wave);
    }

    /**
     * Show the form for editing the specified Wave.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $wave = $this->waveRepository->find($id);

        if (empty($wave)) {
            Flash::error('Wave not found');

            return redirect(route('waves.index'));
        }

        return view('waves.edit')->with('wave', $wave);
    }

    /**
     * Update the specified Wave in storage.
     *
     * @param int $id
     * @param UpdateWaveRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateWaveRequest $request)
    {
        $wave = $this->waveRepository->find($id);

        if (empty($wave)) {
            Flash::error('Wave not found');

            return redirect(route('waves.index'));
        }

        $wave = $this->waveRepository->update($request->all(), $id);

        Flash::success('Wave updated successfully.');

        return redirect(route('waves.index'));
    }

    /**
     * Remove the specified Wave from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $wave = $this->waveRepository->find($id);

        if (empty($wave)) {
            Flash::error('Wave not found');

            return redirect(route('waves.index'));
        }

        $this->waveRepository->delete($id);

        Flash::success('Wave deleted successfully.');

        return redirect(route('waves.index'));
    }
}
