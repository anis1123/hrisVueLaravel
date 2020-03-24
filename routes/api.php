<?php

use Illuminate\Http\Request;
use App\Events\NotificationMsg;

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





Route::post('/attendance/{emp_id?}','AttendanceController@mobile_attendace');
Route::post('/attendance/browser/post','AttendanceController@browser_attendance');
Route::post('/attendance/browser/update','AttendanceController@checkOut');
Route::get('/attendance/check/{emp_id?}','AttendanceController@attendance_employee');





//check auth user

Route::get('auth/user/{emp_id}','AuthController@index');

Route::post('/department/add','DepartmentController@store');
Route::post('designation/add','DesignationController@store');


Route::get('employee/export/','ExcelExportController@export');


Route::get('department/get','DepartmentController@get');
Route::get('subdepartment/get','DepartmentController@getSubDep');
Route::get('department/only','DepartmentController@department');


Route::get('testa','LeaveController@test');








Route::get('designation/get','DesignationController@get');
Route::get('designation/only/{id?}','DesignationController@only');
Route::post('excel','ExcelController@excel');


Route::patch('company','CompanyInfController@store');
Route::post('company/logo','CompanyInfController@upload');
Route::get('company/get','CompanyInfController@get');

Route::post('/date/{id}','AttendanceController@store');
Route::post('/attendance/all','AttendanceController@update');
Route::get('/attendance/get','AttendanceController@get');
Route::get('/attendance/get-new/{date?}','AttendanceController@empget');
Route::post('/attendance/store/{dep_id?}/{date?}','AttendanceController@attendance');

Route::get('/attendance/check/{date}/{id}','AttendanceController@check');

Route::get('/send','MailController@send');


Route::get('/calender','ExcelController@calender');



Route::post('/import/{date?}', 'ExcelController@import');


Route::get('/excel/export','ExcelController@export');


Route::post('/leave/post/{emp_id?}','LeaveController@index');
Route::get('/leave/get/{emp_id?}','LeaveController@get');

Route::get('/leave/get/id/{id?}','LeaveController@getleaveId');

Route::put('/leave/edit/{id?}','LeaveController@edit');

Route::get('/leave/delete/{id?}','LeaveController@delete');
Route::get('/att_check/{id?}','AttendanceController@check_att');


Route::get('/anis',function(Request $req){
    $id = 'anis';
    event(new App\Events\NotificationMsg($id));
});

Route::post('/testa','LeaveController@test');

Route::get('/msg','LeaveController@get_msg');

Route::get('/notify','LeaveController@get_leave_notif');
Route::post('/status/{id?}','LeaveController@status');

Route::get('holiday/get','HolidayController@index');

Route::post('holiday/post/{emp_id?}','HolidayController@post');

Route::get('schedule/get','ScheduleController@index');

Route::post('schedule/post/{emp_id?}','ScheduleController@post');


//loan
Route::post('loan/post','LoanController@post');
Route::patch('loan/edit/{id}','LoanController@edit_post');
Route::get('loan/get/{id?}','LoanController@get');
Route::get('loan/edit/{id?}','LoanController@edit');


//setting emp
Route::post('/employee/setting','SettingController@empSetting');
Route::get('/employee/setting/get','SettingController@getEmpSetting');

//setting worktype
Route::post('post/setting/worktype','SettingController@workType');
Route::post('edit/setting/worktype/{id}','SettingController@editWorkType');
Route::get('get/setting/worktype/{id?}','SettingController@getWorkType');
Route::get('delete/setting/worktype/{id}','SettingController@deleteWorkType');

// subdepartment
Route::post('/subdepartment/add','DepartmentController@subDepartment');
Route::post('subdesignation/add','DesignationController@subDepartmentDes');

Route::post('tax_info/store','TaxInformationController@update');

//salary level
Route::resource('salarylevel','SalaryLevelController');

//salary history
Route::resource('salaryhistory','SalaryHistoryController');

//loantype
Route::resource('loantype','LoanTypeController');

//loanpay
Route::resource('loanpay','LoanPayController');
