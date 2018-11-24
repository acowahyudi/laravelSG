<?php

namespace App\Http\Controllers\API;
use App\Models\JenisParameter;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;
use App\Models\Unit;


class HasilAPIController extends AppBaseController
{


    public function store(Request $request)
    {
        $input=$request->all();
        $unit=Unit::find($input['unit_id']);
        $jenis_parameter=JenisParameter::find($input['jenis_parameter_id']);
        $unit->jenisParameters()->attach($jenis_parameter, ['value' => $input['value']]);
        return $this->sendResponse($unit->toArray(), 'Hasil saved successfully');
    }
}
