<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'DashboardController@index')->name('dashboard');
Route::get('login', 'DashboardController@login')->name('login');
Route::post('login-process', 'DashboardController@loginProcess')->name('login.proses');
Route::get('logout', 'DashboardController@logout')->name('logout');

Route::middleware(['auth'])->group(function (){

    Route::group(['namespace'=>'PengaturanAplikasi', 'prefix'=>'pengaturan-aplikasi'], function () {

        /**
         * Pengaturan Aplikasi
         */
        Route::group(['prefix'=>'manajemen-user'], function () {
            /** Untuk manajemen User */
            Route::resource('user','UserController');
            /** Untuk manajemen Role */
            Route::resource('role', 'RoleController');
            Route::post('role/data','RoleController@getRoleData')->name('role.getdata');
            Route::get('role/{role}/delete','RoleController@delete')->name('role.delete');
            /** Untuk manajemen Permission */
            Route::resource('permission', 'PermissionController');
            Route::post('permission/data','PermissionController@getPermissionData')->name('permission.getdata');
            Route::get('permission/{role}/delete','PermissionController@delete')->name('permission.delete');
        });
    });

});
