<?php

namespace App\Http\Controllers;

use App\DataTables\ReceiverDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateReceiverRequest;
use App\Http\Requests\UpdateReceiverRequest;
use App\Repositories\ReceiverRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class ReceiverController extends AppBaseController
{
    /** @var ReceiverRepository $receiverRepository*/
    private $receiverRepository;

    public function __construct(ReceiverRepository $receiverRepo)
    {
        $this->receiverRepository = $receiverRepo;
    }

    /**
     * Display a listing of the Receiver.
     *
     * @param ReceiverDataTable $receiverDataTable
     *
     * @return Response
     */
    public function index(ReceiverDataTable $receiverDataTable)
    {
        return $receiverDataTable->render('receivers.index');
    }

    /**
     * Show the form for creating a new Receiver.
     *
     * @return Response
     */
    public function create()
    {
        return view('receivers.create');
    }

    /**
     * Store a newly created Receiver in storage.
     *
     * @param CreateReceiverRequest $request
     *
     * @return Response
     */
    public function store(CreateReceiverRequest $request)
    {
        $input = $request->all();

        $receiver = $this->receiverRepository->create($input);

        Flash::success('Receiver saved successfully.');

        return redirect(route('receivers.index'));
    }

    /**
     * Display the specified Receiver.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $receiver = $this->receiverRepository->find($id);

        if (empty($receiver)) {
            Flash::error('Receiver not found');

            return redirect(route('receivers.index'));
        }

        return view('receivers.show')->with('receiver', $receiver);
    }

    /**
     * Show the form for editing the specified Receiver.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $receiver = $this->receiverRepository->find($id);

        if (empty($receiver)) {
            Flash::error('Receiver not found');

            return redirect(route('receivers.index'));
        }

        return view('receivers.edit')->with('receiver', $receiver);
    }

    /**
     * Update the specified Receiver in storage.
     *
     * @param int $id
     * @param UpdateReceiverRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateReceiverRequest $request)
    {
        $receiver = $this->receiverRepository->find($id);

        if (empty($receiver)) {
            Flash::error('Receiver not found');

            return redirect(route('receivers.index'));
        }

        $receiver = $this->receiverRepository->update($request->all(), $id);

        Flash::success('Receiver updated successfully.');

        return redirect(route('receivers.index'));
    }

    /**
     * Remove the specified Receiver from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $receiver = $this->receiverRepository->find($id);

        if (empty($receiver)) {
            Flash::error('Receiver not found');

            return redirect(route('receivers.index'));
        }

        $this->receiverRepository->delete($id);

        Flash::success('Receiver deleted successfully.');

        return redirect(route('receivers.index'));
    }
}
