<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createjenis_parameterRequest;
use App\Http\Requests\Updatejenis_parameterRequest;
use App\Repositories\jenis_parameterRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class jenis_parameterController extends AppBaseController
{
    /** @var  jenis_parameterRepository */
    private $jenisParameterRepository;

    public function __construct(jenis_parameterRepository $jenisParameterRepo)
    {
        $this->jenisParameterRepository = $jenisParameterRepo;
    }

    /**
     * Display a listing of the jenis_parameter.
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
     * Show the form for creating a new jenis_parameter.
     *
     * @return Response
     */
    public function create()
    {
        return view('jenis_parameters.create');
    }

    /**
     * Store a newly created jenis_parameter in storage.
     *
     * @param Createjenis_parameterRequest $request
     *
     * @return Response
     */
    public function store(Createjenis_parameterRequest $request)
    {
        $input = $request->all();

        $jenisParameter = $this->jenisParameterRepository->create($input);

        Flash::success('Jenis Parameter saved successfully.');

        return redirect(route('jenisParameters.index'));
    }

    /**
     * Display the specified jenis_parameter.
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
     * Show the form for editing the specified jenis_parameter.
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
     * Update the specified jenis_parameter in storage.
     *
     * @param  int              $id
     * @param Updatejenis_parameterRequest $request
     *
     * @return Response
     */
    public function update($id, Updatejenis_parameterRequest $request)
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
     * Remove the specified jenis_parameter from storage.
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
