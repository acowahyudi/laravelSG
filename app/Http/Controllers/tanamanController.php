<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTanamanRequest;
use App\Http\Requests\UpdateTanamanRequest;
use App\Repositories\TanamanRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class TanamanController extends AppBaseController
{
    /** @var  TanamanRepository */
    private $tanamanRepository;

    public function __construct(TanamanRepository $tanamanRepo)
    {
        $this->tanamanRepository = $tanamanRepo;
    }

    /**
     * Display a listing of the Tanaman.
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
     * Show the form for creating a new Tanaman.
     *
     * @return Response
     */
    public function create()
    {
        return view('tanamen.create');
    }

    /**
     * Store a newly created Tanaman in storage.
     *
     * @param CreateTanamanRequest $request
     *
     * @return Response
     */
    public function store(CreateTanamanRequest $request)
    {
        $input = $request->all();

        $tanaman = $this->tanamanRepository->create($input);

        Flash::success('Tanaman saved successfully.');

        return redirect(route('tanamen.index'));
    }

    /**
     * Display the specified Tanaman.
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
     * Show the form for editing the specified Tanaman.
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
     * Update the specified Tanaman in storage.
     *
     * @param  int              $id
     * @param UpdateTanamanRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTanamanRequest $request)
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
     * Remove the specified Tanaman from storage.
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
