<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your module. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

use App\Modules\Superadmin\Models\User;

Route::group(['prefix' => 'admin'], function () {
    Route::get('/', function () {
        dd('This is the Admin module index page. Build something great!');
    });
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    /**********************************Backend Dashboard************************************/
    Route::resource('company', 'CompanyListController')->except('destroy');
    Route::get('company/delete/{id}', 'CompanyListController@destroy')->name('company.destroy');
    Route::get('dashboard', function () {
        $user = User::where('company_id', auth()->user()->company_id)->where('status', 1)->get();
        $users = count($user);
        return view('backend.layouts.admindashboard', compact('users'));
    });


    /**********************************Setting************************************/
    Route::get('setting', 'SettingController@index')->name('setting.index');
    Route::put('setting/{id}', 'SettingController@update')->name('setting.update');
    /**********************************Setting************************************/

    Route::resource('permissions', 'PermissionController');
    Route::resource('roles', 'RoleController');
    Route::resource('users', 'UserController')->except('destroy');
    Route::get('users/delete/{id}', 'UserController@destroy')->name('users.delete');
//Route::get('permissionlist/ajaxget','PermissionController@ajaxget');
    Route::match(['get', 'post'], '/permissionlist/ajaxget/', 'PermissionController@ajaxget');
    Route::match(['get', 'post'], 'getcompanyid', 'PermissionController@getcompanyid')->name('users.getcompanyid');
    Route::match(['get', 'post'], 'getcompanyroles', 'UserController@getcompanyroles')->name('users.getcompanyroles');
    Route::resource('company_users', 'CompanyUserController');
    Route::get('company_users/delete/{id}', 'CompanyUserController@destroy')->name('company_users.delete');

    Route::get('admin/logout', 'SettingController@logout')->name('admin.logout');
});
