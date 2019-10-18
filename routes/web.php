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



Route::group(['middleware' => 'auth'], function () {
    Route::group(['prefix' => 'mgt'], function () {
    
        Route::group(['prefix' => 'cbt'], function () {
            Route::get('kategori', 'Management\CBT\KategoriController@Kategori')->name('mgt.cbt.kategori');
            Route::get('kategori/data', 'Management\CBT\KategoriController@AjaxKategoriGetData')->name('mgt.cbt.kategori.data');
            Route::post('kategori/insert', 'Management\CBT\KategoriController@AjaxKategoriInsertData')->name('mgt.cbt.kategori.insert');
            Route::post('kategori/delete', 'Management\CBT\KategoriController@AjaxKategoriDeleteData')->name('mgt.cbt.kategori.delete');

            Route::get('program', 'Management\CBT\ProgramController@Program')->name('mgt.cbt.program');
            Route::get('program/data', 'Management\CBT\ProgramController@AjaxProgramGetData')->name('mgt.cbt.program.data');
            Route::post('program/desc', 'Management\CBT\ProgramController@AjaxProgramGetDesc')->name('mgt.cbt.program.desc');
            Route::post('program/insert', 'Management\CBT\ProgramController@AjaxProgramInsertData')->name('mgt.cbt.program.insert');
            Route::post('program/delete', 'Management\CBT\ProgramController@AjaxProgramDeleteData')->name('mgt.cbt.program.delete');

            Route::get('management', 'Management\CBT\ManagementController@Management')->name('mgt.cbt.management');
            Route::get('management/data', 'Management\CBT\ManagementController@AjaxManagementGetData')->name('mgt.cbt.management.data');
            Route::post('management/insert', 'Management\CBT\ManagementController@AjaxManagementInsertData')->name('mgt.cbt.management.insert');
            Route::post('management/delete', 'Management\CBT\ManagementController@AjaxManagementDeleteData')->name('mgt.cbt.management.delete');

            Route::group(['prefix' => 'materi'], function () {
                Route::get('pembuatan_soal', 'Management\CBT\Materi\MateriController@Management')->name('mgt.cbt.materi');

                Route::get('pembuatan_soal', 'Management\CBT\Materi\MateriController@Management')->name('mgt.cbt.materi.pembuatan_soal');
                Route::get('pembuatan_soal/data', 'Management\CBT\Materi\MateriController@AjaxManagementGetData')->name('mgt.cbt.materi.pembuatan_soal.data');
                Route::post('pembuatan_soal/insert', 'Management\CBT\Materi\MateriController@AjaxManagementInsertData')->name('mgt.cbt.materi.pembuatan_soal.insert');
                Route::post('pembuatan_soal/delete', 'Management\CBT\Materi\MateriController@AjaxManagementDeleteData')->name('mgt.cbt.materi.pembuatan_soal.delete');

                Route::get('modul', 'Management\CBT\Materi\PembuatanModulController@index')->name('mgt.cbt.materi.pembuatan_modul');
                Route::get('modul/data', 'Management\CBT\Materi\PembuatanModulController@AjaxManagementGetData')->name('mgt.cbt.materi.pembuatan_modul.data');
                Route::post('modul/insert', 'Management\CBT\Materi\PembuatanModulController@AjaxManagementInsertData')->name('mgt.cbt.materi.pembuatan_modul.insert');
                Route::post('modul/delete', 'Management\CBT\Materi\PembuatanModulController@AjaxManagementDeleteData')->name('mgt.cbt.materi.pembuatan_modul.delete');
            
                Route::get('submodul', 'Management\CBT\Materi\PembuatanSubModulController@Management')->name('mgt.cbt.materi.pembuatan_submodul');
                Route::get('submodul/data', 'Management\CBT\Materi\PembuatanSubModulController@AjaxManagementGetData')->name('mgt.cbt.materi.pembuatan_submodul.data');
                Route::post('submodul/insert', 'Management\CBT\Materi\PembuatanSubModulController@AjaxManagementInsertData')->name('mgt.cbt.materi.pembuatan_submodul.insert');
                Route::post('submodul/delete', 'Management\CBT\Materi\PembuatanSubModulController@AjaxManagementDeleteData')->name('mgt.cbt.materi.pembuatan_submodul.delete');
            
            });

        });


    });

    Route::group(['prefix' => 'master'], function () {
        Route::get('provinsi', 'Master\ProvinsiController@provinsi')->name('master.provinsi');
        Route::get('provinsi/data', 'Master\ProvinsiController@AjaxProvinsiGetData')->name('master.provinsi.data');
        Route::get('provinsi/json', 'Master\ProvinsiController@ProvinsiJson')->name('master.provinsi.json');
        // Route::get('provinsi/edit', 'MasterDataController@json')->name('master.provinsi.edit');
        Route::post('provinsi/insert', 'Master\ProvinsiController@AjaxProvinsiInsertData')->name('master.provinsi.insert');
        Route::post('provinsi/delete', 'Master\ProvinsiController@AjaxProvinsiDeleteData')->name('master.provinsi.delete');
       
        
        Route::get('kota', 'Master\KotaController@kota')->name('master.kota');
        Route::get('kota/data', 'Master\KotaController@AjaxKotaGetData')->name('master.kota.data');
        Route::post('kota/insert', 'Master\KotaController@AjaxKotaInsertData')->name('master.kota.insert');
        Route::post('kota/delete', 'Master\KotaController@AjaxKotaDeleteData')->name('master.kota.delete');

       

       
    });
});