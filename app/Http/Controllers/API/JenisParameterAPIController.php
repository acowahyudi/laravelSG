<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateJenisParameterAPIRequest;
use App\Http\Requests\API\UpdateJenisParameterAPIRequest;
use App\Models\JenisParameter;
use App\Repositories\JenisParameterRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class JenisParameterController
 * @package App\Http\Controllers\API
 */

class JenisParameterAPIController extends AppBaseController
{
    /** @var  JenisParameterRepository */
    private $jenisParameterRepository;

    public function __construct(JenisParameterRepository $jenisParameterRepo)
    {
        $this->jenisParameterRepository = $jenisParameterRepo;
    }

    /**
     * Display a listing of the JenisParameter.
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
     * Store a newly created JenisParameter in storage.
     * POST /jenisParameters
     *
     * @param CreateJenisParameterAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateJenisParameterAPIRequest $request)
    {
        $input = $request->all();

        $jenisParameters = $this->jenisParameterRepository->create($input);

        return $this->sendResponse($jenisParameters->toArray(), 'Jenis Parameter saved successfully');
    }

    /**
     * Display the specified JenisParameter.
     * GET|HEAD /jenisParameters/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var JenisParameter $jenisParameter */
        $jenisParameter = $this->jenisParameterRepository->findWithoutFail($id);

        if (empty($jenisParameter)) {
            return $this->sendError('Jenis Parameter not found');
        }

        return $this->sendResponse($jenisParameter->toArray(), 'Jenis Parameter retrieved successfully');
    }

    /**
     * Update the specified JenisParameter in storage.
     * PUT/PATCH /jenisParameters/{id}
     *
     * @param  int $id
     * @param UpdateJenisParameterAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateJenisParameterAPIRequest $request)
    {
        $input = $request->all();

        /** @var JenisParameter $jenisParameter */
        $jenisParameter = $this->jenisParameterRepository->findWithoutFail($id);

        if (empty($jenisParameter)) {
            return $this->sendError('Jenis Parameter not found');
        }

        $jenisParameter = $this->jenisParameterRepository->update($input, $id);

        return $this->sendResponse($jenisParameter->toArray(), 'JenisParameter updated successfully');
    }

    /**
     * Remove the specified JenisParameter from storage.
     * DELETE /jenisParameters/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var JenisParameter $jenisParameter */
        $jenisParameter = $this->jenisParameterRepository->findWithoutFail($id);

        if (empty($jenisParameter)) {
            return $this->sendError('Jenis Parameter not found');
        }

        $jenisParameter->delete();

        return $this->sendResponse($id, 'Jenis Parameter deleted successfully');
    }
}
