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
use App\Models\Unit;
/**
 * Class JenisParameterController
 * @package App\Http\Controllers\API
 */

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
