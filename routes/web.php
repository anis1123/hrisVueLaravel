<?php
use App\Events\NotificationMsg;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create someth
ing great!
|
*/


Auth::routes();
Route::get('/',function(){
    broadcast(new NotificationMsg('somedata'));
});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/payslip',function(){

    return view('payslip');
});

Route::get('/test', function(){
    return view('test');
} );

Route::get('verify/{email}/{verifyToken}','Auth\RegisterController@sendEmailDone')->name('sendEmailDone');
Route::get('/chat','MessageController@index');
Route::group(['middleware' => ['auth'], 'prefix' => 'admin'], function () {
    /**********************************Backend Dashboard************************************/
//    Route::match(['get', 'post'], '/dashboard', function () {
//        return view('backend.layouts.dashboard');
//    });
    /**********************************Backend Dashboard************************************/
    /**********************************Department************************************/
    Route::resource('department', 'DepartmentController');
    Route::get('/department/trash/{id}', 'DepartmentController@destroy')->name('department.destroy');
    /**********************************Department************************************/


    Route::get('/installation', 'Install\InstallController@index');

    Route::get('install/database', 'Install\InstallController@database');
    Route::post('install/process_install', 'Install\InstallController@process_install');
    Route::get('install/system_settings', 'Install\InstallController@system_settings');
    Route::post('install/finish', 'Install\InstallController@final_touch');
});



Route::get('login','Admin\AuthController@index')->name('other-login');
Route::post ( '/login', 'Admin\AuthController@login' )->name('user.login');
//Route::post ( '/register', 'MainController@register' );
Route::get ( 'admin/logout', 'Admin\AuthController@logout' );




