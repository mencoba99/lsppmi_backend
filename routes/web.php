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
Route::get('/tt', function () {
    $cert = \App\MemberCertification::findOrFail(10);
    \App\Jobs\CreateAPL02::dispatch($cert);
    echo "string";
    // $units = $cert->schedules->programs->units;
    // foreach ($units as $k => $v) {
    //     dd($v->kuk);
    // }
});

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
            Route::post('user/data', 'UserController@getData')->name('user.getdata');
            Route::get('user/{user}/delete', 'UserController@delete')->name('user.delete');
            Route::get('user/{user}/permission', 'UserController@permission')->name('user.permission');
            /** Untuk manajemen Role */
            Route::resource('role', 'RoleController');
            Route::post('role/data','RoleController@getRoleData')->name('role.getdata');
            Route::get('role/{role}/delete','RoleController@delete')->name('role.delete');
            Route::get('role/{role}/permission','RoleController@permission')->name('role.permission');
            Route::post('role/{role}/permission/{permission}/store','RoleController@permissionStore')->name('role.permission.store');
            /** Untuk manajemen Permission */
            Route::resource('permission', 'PermissionController');
            Route::post('permission/data','PermissionController@getPermissionData')->name('permission.getdata');
            Route::get('permission/{role}/delete','PermissionController@delete')->name('permission.delete');
        });

        
    });

    Route::group(['namespace'=>'Master', 'prefix'=>'master-data'], function () {

        /**
         * Master Data
         */
      
            Route::get('provinsi', 'ProvinsiController@provinsi')->name('master.provinsi');
            Route::get('provinsi/data', 'ProvinsiController@AjaxProvinsiGetData')->name('master.provinsi.data');
            Route::get('provinsi/json', 'ProvinsiController@ProvinsiJson')->name('master.provinsi.json');
            Route::post('provinsi/insert', 'ProvinsiController@AjaxProvinsiInsertData')->name('master.provinsi.insert');
            Route::post('provinsi/delete', 'ProvinsiController@AjaxProvinsiDeleteData')->name('master.provinsi.delete');
           
            
            Route::get('kota', 'KotaController@kota')->name('master.kota');
            Route::get('kota/data', 'KotaController@AjaxKotaGetData')->name('master.kota.data');
            Route::post('kota/insert', 'KotaController@AjaxKotaInsertData')->name('master.kota.insert');
            Route::post('kota/delete', 'KotaController@AjaxKotaDeleteData')->name('master.kota.delete');
    

        
    });

    Route::group(['namespace'=>'management', 'prefix'=>'management-data'], function () {

      
            Route::group(['prefix' => 'cbt'], function () {
                Route::get('kategori', 'CBT\KategoriController@Kategori')->name('mgt.cbt.kategori');
                Route::get('kategori/data', 'CBT\KategoriController@AjaxKategoriGetData')->name('mgt.cbt.kategori.data');
                Route::post('kategori/insert', 'CBT\KategoriController@AjaxKategoriInsertData')->name('mgt.cbt.kategori.insert');
                Route::post('kategori/delete', 'CBT\KategoriController@AjaxKategoriDeleteData')->name('mgt.cbt.kategori.delete');
    
                Route::get('program', 'CBT\ProgramController@Program')->name('mgt.cbt.program');
                Route::get('program/data', 'CBT\ProgramController@AjaxProgramGetData')->name('mgt.cbt.program.data');
                Route::post('program/desc', 'CBT\ProgramController@AjaxProgramGetDesc')->name('mgt.cbt.program.desc');
                Route::post('program/insert', 'CBT\ProgramController@AjaxProgramInsertData')->name('mgt.cbt.program.insert');
                Route::post('program/delete', 'CBT\ProgramController@AjaxProgramDeleteData')->name('mgt.cbt.program.delete');
    
                Route::get('management', 'CBT\ManagementController@index')->name('mgt.cbt.management');
                Route::get('management/data', 'CBT\ManagementController@AjaxMgtProgramGetData')->name('mgt.cbt.management.data');
                Route::post('management/insert', 'CBT\ManagementController@AjaxMgtProgramInsertData')->name('mgt.cbt.management.insert');
                Route::post('management/delete', 'CBT\ManagementController@AjaxMgtProgramDeleteData')->name('mgt.cbt.management.delete');
    
                Route::group(['prefix' => 'materi'], function () {
                    Route::get('jenis-soal', 'CBT\Materi\JenisSoalController@index')->name('mgt.cbt.materi.jenis_soal');
                    Route::get('jenis-soal/data', 'CBT\Materi\JenisSoalController@AjaxJenisSoalGetData')->name('mgt.cbt.materi.jenis_soal.data');
                    Route::post('jenis-soal/insert', 'CBT\Materi\JenisSoalController@AjaxJenisSoalInsertData')->name('mgt.cbt.materi.jenis_soal.insert');
    
                    Route::get('soal', 'CBT\Materi\PembuatanSoalController@index')->name('mgt.cbt.materi.pembuatan_soal');
                    Route::get('soal/data', 'CBT\Materi\PembuatanSoalController@AjaxPembuatanSoalGetData')->name('mgt.cbt.materi.pembuatan_soal.data');
                    Route::post('soal/insert', 'CBT\Materi\PembuatanSoalController@AjaxPembuatanSoalInsertData')->name('mgt.cbt.materi.pembuatan_soal.insert');
                    Route::post('soal/delete', 'CBT\Materi\PembuatanSoalController@AjaxPembuatanSoalDeleteData')->name('mgt.cbt.materi.pembuatan_soal.delete');
    
                    Route::get('modul', 'CBT\Materi\PembuatanModulController@index')->name('mgt.cbt.materi.pembuatan_modul');
                    Route::get('modul/data', 'CBT\Materi\PembuatanModulController@AjaxModulGetData')->name('mgt.cbt.materi.pembuatan_modul.data');
                    Route::post('modul/insert', 'CBT\Materi\PembuatanModulController@AjaxModulInsertData')->name('mgt.cbt.materi.pembuatan_modul.insert');
                    Route::post('modul/delete', 'CBT\Materi\PembuatanModulController@AjaxModulDeleteData')->name('mgt.cbt.materi.pembuatan_modul.delete');
                
                    Route::get('submodul', 'CBT\Materi\PembuatanSubModulController@index')->name('mgt.cbt.materi.pembuatan_submodul');
                    Route::get('submodul/data', 'CBT\Materi\PembuatanSubModulController@AjaxSubModulGetData')->name('mgt.cbt.materi.pembuatan_submodul.data');
                    Route::post('submodul/insert', 'CBT\Materi\PembuatanSubModulController@AjaxSubModulInsertData')->name('mgt.cbt.materi.pembuatan_submodul.insert');
                    Route::post('submodul/delete', 'CBT\Materi\PembuatanSubModulController@AjaxSubModulDeleteData')->name('mgt.cbt.materi.pembuatan_submodul.delete');
                
                });
    
            });
    
    

        
    });

});



