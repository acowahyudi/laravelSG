<?php

namespace App\Http\Controllers\API;
use App\Models\TindakanTanaman;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;


class TindakanTanamanAPIController extends AppBaseController
{


    public function index(Request $request)
    {

        $TindakanTanaman = TindakanTanaman::all();
        return $this->sendResponse($TindakanTanaman->toArray(), 'Tindakan Tanaman retrieved successfully');
    }
}
