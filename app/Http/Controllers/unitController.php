<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateunitRequest;
use App\Http\Requests\UpdateunitRequest;
use App\Repositories\unitRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class unitController extends AppBaseController
{
    /** @var  unitRepository */
    private $unitRepository;

    public function __construct(unitRepository $unitRepo)
    {
        $this->unitRepository = $unitRepo;
    }

    /**
     * Display a listing of the unit.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->unitRepository->pushCriteria(new RequestCriteria($request));
        $units = $this->unitRepository->all();

        return view('units.index')
            ->with('units', $units);
    }

    /**
     * Show the form for creating a new unit.
     *
     * @return Response
     */
    public function create()
    {
        return view('units.create');
    }

    /**
     * Store a newly created unit in storage.
     *
     * @param CreateunitRequest $request
     *
     * @return Response
     */
    public function store(CreateunitRequest $request)
    {
        $input = $request->all();

        $unit = $this->unitRepository->create($input);

        Flash::success('Unit saved successfully.');

        return redirect(route('units.index'));
    }

    /**
     * Display the specified unit.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $unit = $this->unitRepository->findWithoutFail($id);

        if (empty($unit)) {
            Flash::error('Unit not found');

            return redirect(route('units.index'));
        }

        return view('units.show')->with('unit', $unit);
    }

    /**
     * Show the form for editing the specified unit.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $unit = $this->unitRepository->findWithoutFail($id);

        if (empty($unit)) {
            Flash::error('Unit not found');

            return redirect(route('units.index'));
        }

        return view('units.edit')->with('unit', $unit);
    }

    /**
     * Update the specified unit in storage.
     *
     * @param  int              $id
     * @param UpdateunitRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateunitRequest $request)
    {
        $unit = $this->unitRepository->findWithoutFail($id);

        if (empty($unit)) {
            Flash::error('Unit not found');

            return redirect(route('units.index'));
        }

        $unit = $this->unitRepository->update($request->all(), $id);

        Flash::success('Unit updated successfully.');

        return redirect(route('units.index'));
    }

    /**
     * Remove the specified unit from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $unit = $this->unitRepository->findWithoutFail($id);

        if (empty($unit)) {
            Flash::error('Unit not found');

            return redirect(route('units.index'));
        }

        $this->unitRepository->delete($id);

        Flash::success('Unit deleted successfully.');

        return redirect(route('units.index'));
    }
}
