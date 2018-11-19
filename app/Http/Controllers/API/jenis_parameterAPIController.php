<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Createjenis_parameterAPIRequest;
use App\Http\Requests\API\Updatejenis_parameterAPIRequest;
use App\Models\jenis_parameter;
use App\Repositories\jenis_parameterRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class jenis_parameterController
 * @package App\Http\Controllers\API
 */

class jenis_parameterAPIController extends AppBaseController
{
    /** @var  jenis_parameterRepository */
    private $jenisParameterRepository;

    public function __construct(jenis_parameterRepository $jenisParameterRepo)
    {
        $this->jenisParameterRepository = $jenisParameterRepo;
    }

    /**
     * Display a listing of the jenis_parameter.
     * GET|HEAD /jenisParameters
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->jenisParameterRepository->pushCriteria(new RequestCriteria($request));
        $this->jenisParameterRepository->pushCriteria(new LimitOffsetCriteria($request));
        $jenisParameters = $this->jenisParameterRepository->all();

        return $this->sendResponse($jenisParameters->toArray(), 'Jenis Parameters retrieved successfully');
    }

    /**
     * Store a newly created jenis_parameter in storage.
     * POST /jenisParameters
     *
     * @param Createjenis_parameterAPIRequest $request
     *
     * @return Response
     */
    public function store(Createjenis_parameterAPIRequest $request)
    {
        $input = $request->all();

        $jenisParameters = $this->jenisParameterRepository->create($input);

        return $this->sendResponse($jenisParameters->toArray(), 'Jenis Parameter saved successfully');
    }

    /**
     * Display the specified jenis_parameter.
     * GET|HEAD /jenisParameters/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var jenis_parameter $jenisParameter */
        $jenisParameter = $this->jenisParameterRepository->findWithoutFail($id);

        if (empty($jenisParameter)) {
            return $this->sendError('Jenis Parameter not found');
        }

        return $this->sendResponse($jenisParameter->toArray(), 'Jenis Parameter retrieved successfully');
    }

    /**
     * Update the specified jenis_parameter in storage.
     * PUT/PATCH /jenisParameters/{id}
     *
     * @param  int $id
     * @param Updatejenis_parameterAPIRequest $request
     *
     * @return Response
     */
    public function update($id, Updatejenis_parameterAPIRequest $request)
    {
        $input = $request->all();

        /** @var jenis_parameter $jenisParameter */
        $jenisParameter = $this->jenisParameterRepository->findWithoutFail($id);

        if (empty($jenisParameter)) {
            return $this->sendError('Jenis Parameter not found');
        }

        $jenisParameter = $this->jenisParameterRepository->update($input, $id);

        return $this->sendResponse($jenisParameter->toArray(), 'jenis_parameter updated successfully');
    }

    /**
     * Remove the specified jenis_parameter from storage.
     * DELETE /jenisParameters/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var jenis_parameter $jenisParameter */
        $jenisParameter = $this->jenisParameterRepository->findWithoutFail($id);

        if (empty($jenisParameter)) {
            return $this->sendError('Jenis Parameter not found');
        }

        $jenisParameter->delete();

        return $this->sendResponse($id, 'Jenis Parameter deleted successfully');
    }
}
