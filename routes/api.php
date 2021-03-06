<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('jenis_parameters', 'JenisParameterAPIController');

Route::Post('hasil','HasilAPIController@store');

Route::Get('tindakantanaman','TindakanTanamanAPIController@index');

Route::Get('hasilph', 'HasilAPIController@index');
Route::Get('hasilrh', 'HasilAPIController2@index');