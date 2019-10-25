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

<<<<<<< HEAD


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

            Route::get('management', 'Management\CBT\ManagementController@index')->name('mgt.cbt.management');
            Route::get('management/data', 'Management\CBT\ManagementController@AjaxMgtProgramGetData')->name('mgt.cbt.management.data');
            Route::post('management/insert', 'Management\CBT\ManagementController@AjaxMgtProgramInsertData')->name('mgt.cbt.management.insert');
            Route::post('management/delete', 'Management\CBT\ManagementController@AjaxMgtProgramDeleteData')->name('mgt.cbt.management.delete');

            Route::group(['prefix' => 'materi'], function () {
                Route::get('jenis-soal', 'Management\CBT\Materi\JenisSoalController@index')->name('mgt.cbt.materi.jenis_soal');
                Route::get('jenis-soal/data', 'Management\CBT\Materi\JenisSoalController@AjaxJenisSoalGetData')->name('mgt.cbt.materi.jenis_soal.data');
                Route::post('jenis-soal/insert', 'Management\CBT\Materi\JenisSoalController@AjaxJenisSoalInsertData')->name('mgt.cbt.materi.jenis_soal.insert');

                Route::get('soal', 'Management\CBT\Materi\PembuatanSoalController@index')->name('mgt.cbt.materi.pembuatan_soal');
                Route::get('soal/data', 'Management\CBT\Materi\PembuatanSoalController@AjaxPembuatanSoalGetData')->name('mgt.cbt.materi.pembuatan_soal.data');
                Route::post('soal/insert', 'Management\CBT\Materi\PembuatanSoalController@AjaxPembuatanSoalInsertData')->name('mgt.cbt.materi.pembuatan_soal.insert');
                Route::post('soal/delete', 'Management\CBT\Materi\PembuatanSoalController@AjaxPembuatanSoalDeleteData')->name('mgt.cbt.materi.pembuatan_soal.delete');

                Route::get('modul', 'Management\CBT\Materi\PembuatanModulController@index')->name('mgt.cbt.materi.pembuatan_modul');
                Route::get('modul/data', 'Management\CBT\Materi\PembuatanModulController@AjaxModulGetData')->name('mgt.cbt.materi.pembuatan_modul.data');
                Route::post('modul/insert', 'Management\CBT\Materi\PembuatanModulController@AjaxModulInsertData')->name('mgt.cbt.materi.pembuatan_modul.insert');
                Route::post('modul/delete', 'Management\CBT\Materi\PembuatanModulController@AjaxModulDeleteData')->name('mgt.cbt.materi.pembuatan_modul.delete');
            
                Route::get('submodul', 'Management\CBT\Materi\PembuatanSubModulController@index')->name('mgt.cbt.materi.pembuatan_submodul');
                Route::get('submodul/data', 'Management\CBT\Materi\PembuatanSubModulController@AjaxSubModulGetData')->name('mgt.cbt.materi.pembuatan_submodul.data');
                Route::post('submodul/insert', 'Management\CBT\Materi\PembuatanSubModulController@AjaxSubModulInsertData')->name('mgt.cbt.materi.pembuatan_submodul.insert');
                Route::post('submodul/delete', 'Management\CBT\Materi\PembuatanSubModulController@AjaxSubModulDeleteData')->name('mgt.cbt.materi.pembuatan_submodul.delete');
            
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
=======
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

});
>>>>>>> fa70d974c5c0c1209cf60dfc3d94305687d5dea0
