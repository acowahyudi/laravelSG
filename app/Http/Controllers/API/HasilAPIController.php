<?php

namespace App\Http\Controllers\API;
use App\Models\Hasil;
use App\Models\JenisParameter;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;
use App\Models\Unit;


class HasilAPIController extends AppBaseController
{
    public function index(Request $request)
    {

        $Hasil = Hasil::where('jenis_parameter_id',1)
                        ->orderBy('created_at')
                        ->take(5)
                        ->get();
        return $this->sendResponse($Hasil, 'Hasil pH retrieved successfully');
    }

    public function store(Request $request)
    {
        $input=$request->all();
        $unit=Unit::find($input['unit_id']);
        $jenis_parameter=JenisParameter::find($input['jenis_parameter_id']);
        $unit->jenisParameters()->attach($jenis_parameter, ['value' => $input['value']]);
        return $this->sendResponse($unit->toArray(), 'Hasil saved successfully');
    }
}
