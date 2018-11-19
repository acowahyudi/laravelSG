<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatetindakanAPIRequest;
use App\Http\Requests\API\UpdatetindakanAPIRequest;
use App\Models\tindakan;
use App\Repositories\tindakanRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class tindakanController
 * @package App\Http\Controllers\API
 */

class tindakanAPIController extends AppBaseController
{
    /** @var  tindakanRepository */
    private $tindakanRepository;

    public function __construct(tindakanRepository $tindakanRepo)
    {
        $this->tindakanRepository = $tindakanRepo;
    }

    /**
     * Display a listing of the tindakan.
     * GET|HEAD /tindakans
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->tindakanRepository->pushCriteria(new RequestCriteria($request));
        $this->tindakanRepository->pushCriteria(new LimitOffsetCriteria($request));
        $tindakans = $this->tindakanRepository->all();

        return $this->sendResponse($tindakans->toArray(), 'Tindakans retrieved successfully');
    }

    /**
     * Store a newly created tindakan in storage.
     * POST /tindakans
     *
     * @param CreatetindakanAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatetindakanAPIRequest $request)
    {
        $input = $request->all();

        $tindakans = $this->tindakanRepository->create($input);

        return $this->sendResponse($tindakans->toArray(), 'Tindakan saved successfully');
    }

    /**
     * Display the specified tindakan.
     * GET|HEAD /tindakans/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var tindakan $tindakan */
        $tindakan = $this->tindakanRepository->findWithoutFail($id);

        if (empty($tindakan)) {
            return $this->sendError('Tindakan not found');
        }

        return $this->sendResponse($tindakan->toArray(), 'Tindakan retrieved successfully');
    }

    /**
     * Update the specified tindakan in storage.
     * PUT/PATCH /tindakans/{id}
     *
     * @param  int $id
     * @param UpdatetindakanAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatetindakanAPIRequest $request)
    {
        $input = $request->all();

        /** @var tindakan $tindakan */
        $tindakan = $this->tindakanRepository->findWithoutFail($id);

        if (empty($tindakan)) {
            return $this->sendError('Tindakan not found');
        }

        $tindakan = $this->tindakanRepository->update($input, $id);

        return $this->sendResponse($tindakan->toArray(), 'tindakan updated successfully');
    }

    /**
     * Remove the specified tindakan from storage.
     * DELETE /tindakans/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var tindakan $tindakan */
        $tindakan = $this->tindakanRepository->findWithoutFail($id);

        if (empty($tindakan)) {
            return $this->sendError('Tindakan not found');
        }

        $tindakan->delete();

        return $this->sendResponse($id, 'Tindakan deleted successfully');
    }
}
