<?php

namespace App\Http\Controllers\API;
use App\Models\Hasil;
use App\Models\JenisParameter;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;
use App\Models\Unit;


class HasilAPIController2 extends AppBaseController
{
    public function index(Request $request)
    {

        $Hasil = Hasil::where('jenis_parameter_id',2)
                        ->orderBy('created_at')
                        ->take(5)
                        ->get();
        return $this->sendResponse($Hasil, 'Hasil RH retrieved successfully');
    }

}
