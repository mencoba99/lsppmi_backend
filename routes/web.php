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
Route::get('ujian/start/{id}', 'Ujian\Ujian_perdanaController@start_ujian')->name('start');
Route::get('ujian/index/{id}', 'Ujian\Ujian_perdanaController@index')->name('index');
Route::get('print_ujian', 'Ujian\Ujian_perdanaController@print_ujian')->name('print_ujian');
Route::post('login-process', 'DashboardController@loginProcess')->name('login.proses');
Route::get('logout', 'DashboardController@logout')->name('logout');

Route::post('ujian/perdana/password_ulang/{emp_id}', 'Ujian\Ujian_perdanaController@ajax_password_ulang');
	Route::post('ujian/perdana/save_peserta_jawab', 'Ujian\Ujian_perdanaController@ajax_save_peserta_jawab');
	Route::post('ujian/perdana/save_persentase_kelulusan', 'Ujian\Ujian_perdanaController@ajax_persentase_kelulusan');

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

            Route::get('units', 'UnitsController@index')->name('master.units');
            Route::get('units/data', 'UnitsController@AjaxGetData')->name('master.units.data');
            Route::post('units/insert', 'UnitsController@AjaxInsertData')->name('master.units.insert');

            Route::get('element', 'ElementController@index')->name('master.element');
            Route::get('element/data', 'ElementController@AjaxGetData')->name('master.element.data');
            Route::post('element/insert', 'ElementController@AjaxInsertData')->name('master.element.insert');

            Route::get('kuk', 'KUKController@index')->name('master.kuk');
            Route::get('kuk/data', 'KUKController@AjaxGetData')->name('master.kuk.data');
            Route::post('kuk/insert', 'KUKController@AjaxInsertData')->name('master.kuk.insert');

            Route::get('places', 'PlacesController@index')->name('master.places');
            Route::get('places/data', 'PlacesController@AjaxGetData')->name('master.places.data');
            Route::post('places/insert', 'PlacesController@AjaxInsertData')->name('master.places.insert');
           
        
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
            Route::get('management/create', 'CBT\ManagementController@create')->name('ujian-komputer.management.create');
            Route::get('management/data', 'CBT\ManagementController@AjaxMgtProgramGetData')->name('ujian-komputer.management.data');
            Route::post('management/modul', 'CBT\ManagementController@AjaxGetSubModul')->name('ujian-komputer.management.modul');
            Route::post('management/insert', 'CBT\ManagementController@AjaxMgtProgramInsertData')->name('ujian-komputer.management.insert');
            Route::get('management/{mgtprogram}/delete', 'CBT\ManagementController@AjaxMgtProgramDeleteData')->name('ujian-komputer.management.delete');
            Route::get('management/{mgtprogram}/show', 'CBT\ManagementController@show')->name('ujian-komputer.management.show');
            Route::get('management/{mgtprogram}/edit', 'CBT\ManagementController@show')->name('ujian-komputer.management.edit');

            Route::group(['prefix' => 'materi'], function () {
                Route::get('jenis', 'CBT\Materi\JenisSoalController@index')->name('materi.jenis-soal');
                Route::get('jenis/data', 'CBT\Materi\JenisSoalController@AjaxJenisSoalGetData')->name('materi.jenis-soal.data');
                Route::post('jenis/insert', 'CBT\Materi\JenisSoalController@AjaxJenisSoalInsertData')->name('materi.jenis-soal.insert');

                Route::get('soal', 'CBT\Materi\PembuatanSoalController@index')->name('materi.pembuatan-soal');
                Route::get('soal/data', 'CBT\Materi\PembuatanSoalController@AjaxPembuatanSoalGetData')->name('materi.pembuatan-soal.data');
                Route::post('soal/modul', 'CBT\Materi\PembuatanSoalController@AjaxGetSubmodul')->name('materi.pembuatan-soal.modul');
                Route::post('soal/id', 'CBT\Materi\PembuatanSoalController@AjaxGetId')->name('materi.pembuatan-soal.findId');
                Route::post('soal/insert', 'CBT\Materi\PembuatanSoalController@AjaxPembuatanSoalInsertData')->name('materi.pembuatan-soal.insert');
                Route::post('soal/parent', 'CBT\Materi\PembuatanSoalController@AjaxGetParent')->name('materi.pembuatan-soal.parent');
                Route::post('soal/delete', 'CBT\Materi\PembuatanSoalController@AjaxPembuatanSoalDeleteData')->name('materi.pembuatan-soal.delete');
                Route::get('soal/{soal}/show', 'CBT\Materi\PembuatanSoalController@show')->name('materi.pembuatan-soal.show');
                Route::get('soal/{soal}/edit', 'CBT\Materi\PembuatanSoalController@show')->name('materi.pembuatan-soal.edit');

                Route::get('modul', 'CBT\Materi\PembuatanModulController@index')->name('materi.pembuatan-modul');
                Route::get('modul/data', 'CBT\Materi\PembuatanModulController@AjaxModulGetData')->name('materi.pembuatan-modul.data');
                Route::post('modul/insert', 'CBT\Materi\PembuatanModulController@AjaxModulInsertData')->name('materi.pembuatan-modul.insert');
                Route::post('modul/delete', 'CBT\Materi\PembuatanModulController@AjaxModulDeleteData')->name('materi.pembuatan-modul.delete');
            
                Route::get('submodul', 'CBT\Materi\PembuatanSubModulController@index')->name('materi.pembuatan-submodul');
                Route::get('submodul/data', 'CBT\Materi\PembuatanSubModulController@AjaxSubModulGetData')->name('materi.pembuatan-submodul.data');
                Route::post('submodul/insert', 'CBT\Materi\PembuatanSubModulController@AjaxSubModulInsertData')->name('materi.pembuatan-submodul.insert');
                Route::post('submodul/delete', 'CBT\Materi\PembuatanSubModulController@AjaxSubModulDeleteData')->name('materi.pembuatan-submodul.delete');
            
            });

            Route::group(['prefix' => 'ujian'], function () {
               
                Route::get('jadwal', 'CBT\Ujian\JadwalController@index')->name('ujian.jadwal');
                Route::get('jadwal/batch', 'CBT\Ujian\JadwalController@ajax_get_batch_peserta')->name('ujian.jadwal.batch');
                Route::get('jadwal/program', 'CBT\Ujian\JadwalController@ajax_get_batch')->name('ujian.jadwal.program');
                Route::get('jadwal/peserta', 'CBT\Ujian\JadwalController@ajax_get_peserta')->name('ujian.jadwal.peserta');
                Route::get('jadwal/create', 'CBT\Ujian\JadwalController@create')->name('ujian.jadwal.create');
                Route::get('jadwal/data', 'CBT\Ujian\JadwalController@AjaxJadwalGetData')->name('ujian.jadwal.data');
                Route::post('jadwal/insert', 'CBT\Ujian\JadwalController@AjaxJadwalInsertData')->name('ujian.jadwal.insert');
                Route::get('jadwal/{id}/delete', 'CBT\Ujian\JadwalController@AjaxJadwalInsertData')->name('ujian.jadwal.delete');
                Route::get('jadwal/{id}/edit', 'CBT\Ujian\JadwalController@AjaxJadwalInsertData')->name('ujian.jadwal.edit');
                Route::get('jadwal/{id}/show', 'CBT\Ujian\JadwalController@show')->name('ujian.jadwal.edit');

                Route::get('parameter', 'CBT\Ujian\ParameterController@index')->name('ujian.parameter');
                Route::get('parameter/create', 'CBT\Ujian\ParameterController@create')->name('ujian.parameter.create');
                Route::get('parameter/data', 'CBT\Ujian\ParameterController@data')->name('ujian.parameter.data');
                Route::post('parameter/insert', 'CBT\Ujian\ParameterController@insert')->name('ujian.parameter.insert');
                Route::get('parameter/{ujian_parameter_id}/delete', 'CBT\Ujian\ParameterController@delete')->name('ujian.parameter.delete');
                Route::get('parameter/{ujian_parameter_id}/edit', 'CBT\Ujian\ParameterController@edit')->name('ujian.parameter.edit');
                Route::get('parameter/{ujian_parameter_id}/show', 'CBT\Ujian\ParameterController@show')->name('ujian.parameter.show');

                Route::get('jenis', 'CBT\Ujian\JenisController@index')->name('ujian.jenis');
                Route::get('jenis/create', 'CBT\Ujian\JenisController@create')->name('ujian.jenis.create');
                Route::get('jenis/data', 'CBT\Ujian\JenisController@data')->name('ujian.jenis.data');
                Route::post('jenis/insert', 'CBT\Ujian\JenisController@insert')->name('ujian.jenis.insert');
                Route::post('jenis/update', 'CBT\Ujian\JenisController@update')->name('ujian.jenis.update');
                Route::get('jenis/{ujian_jenis_id}/delete', 'CBT\Ujian\JenisController@delete')->name('ujian.jenis.delete');
                Route::get('jenis/{ujian_jenis_id}/edit', 'CBT\Ujian\JenisController@edit')->name('ujian.jenis.edit');
                Route::get('jenis/{ujian_jenis_id}/show', 'CBT\Ujian\JenisController@show')->name('ujian.jenis.show');

               
            
            });

        });

    });

});
