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

Route::middleware('auth:api')->get('/employee', function (Request $request) {
    return $request->user();
});


Route::post('emp/add', 'EmployeeController@store');

Route::get('emp/get/{id}', 'EmployeeController@edit');


Route::get('employee/get', 'EmployeeController@get');
Route::get('employee/delete/{id}', 'EmployeeController@delete');
Route::patch('employee/update/{id}', 'EmployeeController@update');

Route::post('employee/add/photo', 'EmployeeController@upload');


Route::post('formSubmit', 'EmployeeController@formSubmit');
Route::post('offer', 'EmployeeController@offerletter');
Route::post('joining', 'EmployeeController@joiningletter');
Route::post('contract', 'EmployeeController@contract');
Route::post('id', 'EmployeeController@idproof');
Route::post('other', 'EmployeeController@otherdocument');


Route::get('/emp/{id}', 'EmployeeController@empget');


Route::get('/department', 'EmployeeController@department');


Route::get('/designation', 'EmployeeController@designation');

Route::get('/users/{email}','EmployeeController@users');

Route::get('/usersID/{id}','EmployeeController@usersid');
Route::post('/emp_id/check/{id}','EmployeeController@checkID');
Route::get('employee/email/{email}','EmployeeController@emailcheck');

Route::get('employee/emp_id/{id}','EmployeeController@emp_id');

Route::post('/newpayslip','EmployeeController@newpayslip');

Route::get('/payslip/check/{date?}','EmployeeController@checkpayslip');
Route::post('/login/check','EmployeeController@checklogin');
Route::get('/user_check/{id?}','EmployeeController@usersid_android');

Route::get('emp_id/check/{id?}','EmployeeController@check_id');
Route::get('information/{id?}','EmployeeController@information');


