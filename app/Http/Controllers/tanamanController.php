<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatetanamanRequest;
use App\Http\Requests\UpdatetanamanRequest;
use App\Repositories\tanamanRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class tanamanController extends AppBaseController
{
    /** @var  tanamanRepository */
    private $tanamanRepository;

    public function __construct(tanamanRepository $tanamanRepo)
    {
        $this->tanamanRepository = $tanamanRepo;
    }

    /**
     * Display a listing of the tanaman.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->tanamanRepository->pushCriteria(new RequestCriteria($request));
        $tanamen = $this->tanamanRepository->all();

        return view('tanamen.index')
            ->with('tanamen', $tanamen);
    }

    /**
     * Show the form for creating a new tanaman.
     *
     * @return Response
     */
    public function create()
    {
        return view('tanamen.create');
    }

    /**
     * Store a newly created tanaman in storage.
     *
     * @param CreatetanamanRequest $request
     *
     * @return Response
     */
    public function store(CreatetanamanRequest $request)
    {
        $input = $request->all();

        $tanaman = $this->tanamanRepository->create($input);

        Flash::success('Tanaman saved successfully.');

        return redirect(route('tanamen.index'));
    }

    /**
     * Display the specified tanaman.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $tanaman = $this->tanamanRepository->findWithoutFail($id);

        if (empty($tanaman)) {
            Flash::error('Tanaman not found');

            return redirect(route('tanamen.index'));
        }

        return view('tanamen.show')->with('tanaman', $tanaman);
    }

    /**
     * Show the form for editing the specified tanaman.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $tanaman = $this->tanamanRepository->findWithoutFail($id);

        if (empty($tanaman)) {
            Flash::error('Tanaman not found');

            return redirect(route('tanamen.index'));
        }

        return view('tanamen.edit')->with('tanaman', $tanaman);
    }

    /**
     * Update the specified tanaman in storage.
     *
     * @param  int              $id
     * @param UpdatetanamanRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatetanamanRequest $request)
    {
        $tanaman = $this->tanamanRepository->findWithoutFail($id);

        if (empty($tanaman)) {
            Flash::error('Tanaman not found');

            return redirect(route('tanamen.index'));
        }

        $tanaman = $this->tanamanRepository->update($request->all(), $id);

        Flash::success('Tanaman updated successfully.');

        return redirect(route('tanamen.index'));
    }

    /**
     * Remove the specified tanaman from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $tanaman = $this->tanamanRepository->findWithoutFail($id);

        if (empty($tanaman)) {
            Flash::error('Tanaman not found');

            return redirect(route('tanamen.index'));
        }

        $this->tanamanRepository->delete($id);

        Flash::success('Tanaman deleted successfully.');

        return redirect(route('tanamen.index'));
    }
}
