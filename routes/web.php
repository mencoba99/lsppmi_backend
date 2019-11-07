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

    /**
     * Untuk group  dengan prefix "Data Master"
     */
    Route::group(['namespace'=>'DataMaster', 'prefix'=>'data-master'], function () {
        /**
         * Data Master
         */
        Route::group(['prefix'=>'manajemen-kelas'], function () {
            /** Manajemen Assessor */
            Route::resource('assessor', 'AssessorController');
            Route::post('assessor/data', 'AssessorController@getAssessorData')->name('assessor.getdata');
            Route::get('assessor/{assessor}/delete', 'AssessorController@delete')->name('assessor.delete');

            /** Manajemen TUK (Tempat Uji Kompetensi */
            Route::resource('tuk','TukController');
            Route::post('tuk/data', 'TukController@getTukData')->name('tuk.getdata');
            Route::post('tuk/getregency','TukController@getRegency')->name('tuk.getregency');
            Route::get('tuk/{tuk}/delete', 'TukController@delete')->name('tuk.delete');

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
    });

    Route::group(['namespace'=>'ManajemenAssessmen', 'prefix'=>'management-assesmen'], function () {
        Route::group(['prefix' => 'cbt'], function () {
            Route::get('kategori', 'CBT\KategoriController@Kategori')->name('ujian-komputer.kategori');
            Route::get('kategori/data', 'CBT\KategoriController@AjaxKategoriGetData')->name('ujian-komputer.kategori.data');
            Route::post('kategori/insert', 'CBT\KategoriController@AjaxKategoriInsertData')->name('ujian-komputer.kategori.insert');
            Route::post('kategori/delete', 'CBT\KategoriController@AjaxKategoriDeleteData')->name('ujian-komputer.kategori.delete');

            Route::get('program', 'CBT\ProgramController@Program')->name('ujian-komputer.program');
            Route::get('program/data', 'CBT\ProgramController@AjaxProgramGetData')->name('ujian-komputer.program.data');
            Route::post('program/desc', 'CBT\ProgramController@AjaxProgramGetDesc')->name('ujian-komputer.program.desc');
            Route::post('program/insert', 'CBT\ProgramController@AjaxProgramInsertData')->name('ujian-komputer.program.insert');
            Route::post('program/delete', 'CBT\ProgramController@AjaxProgramDeleteData')->name('ujian-komputer.program.delete');

            Route::get('management', 'CBT\ManagementController@index')->name('ujian-komputer.management');
            Route::get('management/data', 'CBT\ManagementController@AjaxMgtProgramGetData')->name('ujian-komputer.management.data');
            Route::post('management/insert', 'CBT\ManagementController@AjaxMgtProgramInsertData')->name('ujian-komputer.management.insert');
            Route::post('management/delete', 'CBT\ManagementController@AjaxMgtProgramDeleteData')->name('ujian-komputer.management.delete');

            Route::group(['prefix' => 'materi'], function () {
                Route::get('jenis', 'CBT\Materi\JenisSoalController@index')->name('materi.jenis-soal');
                Route::get('jenis/data', 'CBT\Materi\JenisSoalController@AjaxJenisSoalGetData')->name('materi.jenis-soal.data');
                Route::post('jenis/insert', 'CBT\Materi\JenisSoalController@AjaxJenisSoalInsertData')->name('materi.jenis-soal.insert');

                Route::get('soal', 'CBT\Materi\PembuatanSoalController@index')->name('materi.pembuatan-soal');
                Route::get('soal/data', 'CBT\Materi\PembuatanSoalController@AjaxPembuatanSoalGetData')->name('materi.pembuatan-soal.data');
                Route::post('soal/insert', 'CBT\Materi\PembuatanSoalController@AjaxPembuatanSoalInsertData')->name('materi.pembuatan-soal.insert');
                Route::post('soal/delete', 'CBT\Materi\PembuatanSoalController@AjaxPembuatanSoalDeleteData')->name('materi.pembuatan-soal.delete');

                Route::get('modul', 'CBT\Materi\PembuatanModulController@index')->name('materi.pembuatan-modul');
                Route::get('modul/data', 'CBT\Materi\PembuatanModulController@AjaxModulGetData')->name('materi.pembuatan-modul.data');
                Route::post('modul/insert', 'CBT\Materi\PembuatanModulController@AjaxModulInsertData')->name('materi.pembuatan-modul.insert');
                Route::post('modul/delete', 'CBT\Materi\PembuatanModulController@AjaxModulDeleteData')->name('materi.pembuatan-modul.delete');

                Route::get('submodul', 'CBT\Materi\PembuatanSubModulController@index')->name('materi.pembuatan-submodul');
                Route::get('submodul/data', 'CBT\Materi\PembuatanSubModulController@AjaxSubModulGetData')->name('materi.pembuatan-submodul.data');
                Route::post('submodul/insert', 'CBT\Materi\PembuatanSubModulController@AjaxSubModulInsertData')->name('materi.pembuatan-submodul.insert');
                Route::post('submodul/delete', 'CBT\Materi\PembuatanSubModulController@AjaxSubModulDeleteData')->name('materi.pembuatan-submodul.delete');
            });
        });
    });

    Route::group(['namespace' => 'ManajemenPeserta', 'prefix' => 'management-peserta'], function () {
        Route::group(['prefipostx' => 'peserta'], function () {
            Route::get('peserta', 'MemberController@index')->name('peserta.pendaftaran');
            Route::get('peserta/data', 'MemberController@getPesertaData')->name('peserta.pendaftaran.data');
            Route::get('peserta/sertifikasi', 'MemberController@APL01')->name('peserta.pendaftaran.sertifikasi');
            Route::get('peserta/sertifikasi/apl01/data', 'MemberController@getAPL01Data')->name('peserta.pendaftaran.sertifikasi.data');
            Route::get('peserta/sertifikasi/apl01/view/{token}', 'MemberController@viewAPL01')->name('peserta.pendaftaran.sertifikasi.apl01');
            Route::get('peserta/sertifikasi/pembayaran', 'MemberController@viewPaymentList')->name('peserta.pendaftaran.sertifikasi.pembayaran');
            Route::put('peserta/sertifikasi/pembayaran', 'MemberController@verifyAPL01Payment');
            Route::get('peserta/sertifikasi/pembayaran/data', 'MemberController@getPaymentData')->name('peserta.pendaftaran.sertifikasi.pembayaran.data');
            Route::put('peserta/sertifikasi/apl01/verify', 'MemberController@verifyAPL01');
        });
    });
});
