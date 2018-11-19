<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatetindakanRequest;
use App\Http\Requests\UpdatetindakanRequest;
use App\Repositories\tindakanRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class tindakanController extends AppBaseController
{
    /** @var  tindakanRepository */
    private $tindakanRepository;

    public function __construct(tindakanRepository $tindakanRepo)
    {
        $this->tindakanRepository = $tindakanRepo;
    }

    /**
     * Display a listing of the tindakan.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->tindakanRepository->pushCriteria(new RequestCriteria($request));
        $tindakans = $this->tindakanRepository->all();

        return view('tindakans.index')
            ->with('tindakans', $tindakans);
    }

    /**
     * Show the form for creating a new tindakan.
     *
     * @return Response
     */
    public function create()
    {
        return view('tindakans.create');
    }

    /**
     * Store a newly created tindakan in storage.
     *
     * @param CreatetindakanRequest $request
     *
     * @return Response
     */
    public function store(CreatetindakanRequest $request)
    {
        $input = $request->all();

        $tindakan = $this->tindakanRepository->create($input);

        Flash::success('Tindakan saved successfully.');

        return redirect(route('tindakans.index'));
    }

    /**
     * Display the specified tindakan.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $tindakan = $this->tindakanRepository->findWithoutFail($id);

        if (empty($tindakan)) {
            Flash::error('Tindakan not found');

            return redirect(route('tindakans.index'));
        }

        return view('tindakans.show')->with('tindakan', $tindakan);
    }

    /**
     * Show the form for editing the specified tindakan.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $tindakan = $this->tindakanRepository->findWithoutFail($id);

        if (empty($tindakan)) {
            Flash::error('Tindakan not found');

            return redirect(route('tindakans.index'));
        }

        return view('tindakans.edit')->with('tindakan', $tindakan);
    }

    /**
     * Update the specified tindakan in storage.
     *
     * @param  int              $id
     * @param UpdatetindakanRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatetindakanRequest $request)
    {
        $tindakan = $this->tindakanRepository->findWithoutFail($id);

        if (empty($tindakan)) {
            Flash::error('Tindakan not found');

            return redirect(route('tindakans.index'));
        }

        $tindakan = $this->tindakanRepository->update($request->all(), $id);

        Flash::success('Tindakan updated successfully.');

        return redirect(route('tindakans.index'));
    }

    /**
     * Remove the specified tindakan from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $tindakan = $this->tindakanRepository->findWithoutFail($id);

        if (empty($tindakan)) {
            Flash::error('Tindakan not found');

            return redirect(route('tindakans.index'));
        }

        $this->tindakanRepository->delete($id);

        Flash::success('Tindakan deleted successfully.');

        return redirect(route('tindakans.index'));
    }
}
