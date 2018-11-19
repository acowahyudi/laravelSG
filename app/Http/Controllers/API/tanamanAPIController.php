<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatetanamanAPIRequest;
use App\Http\Requests\API\UpdatetanamanAPIRequest;
use App\Models\tanaman;
use App\Repositories\tanamanRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class tanamanController
 * @package App\Http\Controllers\API
 */

class tanamanAPIController extends AppBaseController
{
    /** @var  tanamanRepository */
    private $tanamanRepository;

    public function __construct(tanamanRepository $tanamanRepo)
    {
        $this->tanamanRepository = $tanamanRepo;
    }

    /**
     * Display a listing of the tanaman.
     * GET|HEAD /tanamen
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->tanamanRepository->pushCriteria(new RequestCriteria($request));
        $this->tanamanRepository->pushCriteria(new LimitOffsetCriteria($request));
        $tanamen = $this->tanamanRepository->all();

        return $this->sendResponse($tanamen->toArray(), 'Tanamen retrieved successfully');
    }

    /**
     * Store a newly created tanaman in storage.
     * POST /tanamen
     *
     * @param CreatetanamanAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatetanamanAPIRequest $request)
    {
        $input = $request->all();

        $tanamen = $this->tanamanRepository->create($input);

        return $this->sendResponse($tanamen->toArray(), 'Tanaman saved successfully');
    }

    /**
     * Display the specified tanaman.
     * GET|HEAD /tanamen/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var tanaman $tanaman */
        $tanaman = $this->tanamanRepository->findWithoutFail($id);

        if (empty($tanaman)) {
            return $this->sendError('Tanaman not found');
        }

        return $this->sendResponse($tanaman->toArray(), 'Tanaman retrieved successfully');
    }

    /**
     * Update the specified tanaman in storage.
     * PUT/PATCH /tanamen/{id}
     *
     * @param  int $id
     * @param UpdatetanamanAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatetanamanAPIRequest $request)
    {
        $input = $request->all();

        /** @var tanaman $tanaman */
        $tanaman = $this->tanamanRepository->findWithoutFail($id);

        if (empty($tanaman)) {
            return $this->sendError('Tanaman not found');
        }

        $tanaman = $this->tanamanRepository->update($input, $id);

        return $this->sendResponse($tanaman->toArray(), 'tanaman updated successfully');
    }

    /**
     * Remove the specified tanaman from storage.
     * DELETE /tanamen/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var tanaman $tanaman */
        $tanaman = $this->tanamanRepository->findWithoutFail($id);

        if (empty($tanaman)) {
            return $this->sendError('Tanaman not found');
        }

        $tanaman->delete();

        return $this->sendResponse($id, 'Tanaman deleted successfully');
    }
}
