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

use App\Modules\Superadmin\Models\CompanyList;
use App\Modules\Superadmin\Models\User;

Route::group(['prefix' => 'superadmin'], function () {
    Route::get('/', function () {
        dd('This is the Superadmin module index page. Build something great!');
    });
});

Route::get('admin-login', 'AdminLoginController@showLoginForm');

Route::post('admin-login', ['as'=>'admin-login','uses'=>'AdminLoginController@login']);
//Route::get('super-admin/routes', 'HomeController@admin')->middleware('super-admin');
Route::group(['prefix' => 'super-admin'], function () {
//Route::group(['prefix' => 'super-admin','middleware'=>['super-admin']], function () {
    /**********************************Backend Dashboard************************************/
    Route::resource('company','CompanyListController',['as'=>'super'])->except('destroy');
    Route::get('company/delete/{id}','CompanyListController@destroy')->name('super.company.destroy');
    Route::get('dashboard',function ()
    {
        $users=User::where('status',1)->get();
        $companies=CompanyList::where('status',1)->get();
        return view('backend.layouts.superadmindashboard',compact('users','companies'));
    }
    );
//    Route::get('dashboard','HomeController@index');

    /**********************************Setting************************************/
    Route::get('setting', 'SettingController@index')->name('supersetting.index');
    Route::post('setting', 'SettingController@update')->name('supersetting.update');
    /**********************************Setting************************************/
    Route::resource('permissions', 'PermissionController',['as'=>'super'])->middleware('super-admin');
    Route::resource('roles', 'RoleController',['as'=>'super']);
    Route::resource('users', 'UserController',['as'=>'super'])->except('destroy');
    Route::get('users/delete/{id}', 'UserController@destroy')->name('super.users.delete');
//Route::get('permissionlist/ajaxget','PermissionController@ajaxget');
    Route::match(['get', 'post'], '/permissionlist/ajaxget/', 'PermissionController@ajaxget');
    Route::match(['get', 'post'], 'getcompanyid', 'PermissionController@getcompanyid')->name('super.users.getcompanyid');
    Route::match(['get', 'post'], 'getcompanyroles', 'UserController@getcompanyroles')->name('super.users.getcompanyroles');
    Route::resource('company_users', 'CompanyUserController',['as'=>'super']);
    Route::get('company_users/delete/{id}', 'CompanyUserController@destroy')->name('super.company_users.delete');
});
