<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateJenisParameterRequest;
use App\Http\Requests\UpdateJenisParameterRequest;
use App\Repositories\JenisParameterRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class JenisParameterController extends AppBaseController
{
    /** @var  JenisParameterRepository */
    private $jenisParameterRepository;

    public function __construct(JenisParameterRepository $jenisParameterRepo)
    {
        $this->jenisParameterRepository = $jenisParameterRepo;
    }

    /**
     * Display a listing of the JenisParameter.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->jenisParameterRepository->pushCriteria(new RequestCriteria($request));
        $jenisParameters = $this->jenisParameterRepository->all();

        return view('jenis_parameters.index')
            ->with('jenisParameters', $jenisParameters);
    }

    /**
     * Show the form for creating a new JenisParameter.
     *
     * @return Response
     */
    public function create()
    {
        return view('jenis_parameters.create');
    }

    /**
     * Store a newly created JenisParameter in storage.
     *
     * @param CreateJenisParameterRequest $request
     *
     * @return Response
     */
    public function store(CreateJenisParameterRequest $request)
    {
        $input = $request->all();

        $jenisParameter = $this->jenisParameterRepository->create($input);

        Flash::success('Jenis Parameter saved successfully.');

        return redirect(route('jenisParameters.index'));
    }

    /**
     * Display the specified JenisParameter.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $jenisParameter = $this->jenisParameterRepository->findWithoutFail($id);

        if (empty($jenisParameter)) {
            Flash::error('Jenis Parameter not found');

            return redirect(route('jenisParameters.index'));
        }

        return view('jenis_parameters.show')->with('jenisParameter', $jenisParameter);
    }

    /**
     * Show the form for editing the specified JenisParameter.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $jenisParameter = $this->jenisParameterRepository->findWithoutFail($id);

        if (empty($jenisParameter)) {
            Flash::error('Jenis Parameter not found');

            return redirect(route('jenisParameters.index'));
        }

        return view('jenis_parameters.edit')->with('jenisParameter', $jenisParameter);
    }

    /**
     * Update the specified JenisParameter in storage.
     *
     * @param  int              $id
     * @param UpdateJenisParameterRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateJenisParameterRequest $request)
    {
        $jenisParameter = $this->jenisParameterRepository->findWithoutFail($id);

        if (empty($jenisParameter)) {
            Flash::error('Jenis Parameter not found');

            return redirect(route('jenisParameters.index'));
        }

        $jenisParameter = $this->jenisParameterRepository->update($request->all(), $id);

        Flash::success('Jenis Parameter updated successfully.');

        return redirect(route('jenisParameters.index'));
    }

    /**
     * Remove the specified JenisParameter from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $jenisParameter = $this->jenisParameterRepository->findWithoutFail($id);

        if (empty($jenisParameter)) {
            Flash::error('Jenis Parameter not found');

            return redirect(route('jenisParameters.index'));
        }

        $this->jenisParameterRepository->delete($id);

        Flash::success('Jenis Parameter deleted successfully.');

        return redirect(route('jenisParameters.index'));
    }
}
