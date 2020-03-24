<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your module. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/payslip', function (Request $request) {
    // return $request->payslip();
})->middleware('auth:api');

Route::post('payslip/store','PayslipController@store');
Route::get('payslip/get/new/{date?}','PayslipController@index');
Route::get('payslip/employee/{id}','PayslipController@employee');

Route::get('payslip/gets/{id?}','PayslipController@get');

Route::get('payroll/get','PayslipDetailController@get');
Route::get('payroll/show/{id}','PayslipDetailController@show');
Route::post('payroll/store','PayslipDetailController@store');
Route::patch('payroll/edit/{id}','PayslipDetailController@edit');
Route::delete('payroll/delete/{id}','PayslipDetailController@destroy');

