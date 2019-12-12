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
    echo bcrypt('admin123');
    // $cert = \App\MemberCertification::findOrFail(10);
    // \App\Jobs\CreateAPL02::dispatch($cert);
    // echo "string";
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
            Route::get('permission/{permission}/delete','PermissionController@delete')->name('permission.delete');
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

        Route::group(['prefix'=>'daftar-pertanyaan'], function () {

            Route::resource('tertulis', 'TertulisController');
            Route::post('tertulis/create', 'TertulisController@create')->name('tertulis.create');
            Route::post('tertulis/update/{tertulis}', 'TertulisController@update')->name('tertulis.update');
            Route::post('tertulis/data', 'TertulisController@Getdata')->name('tertulis.getdata');
            Route::post('tertulis/getElement', 'TertulisController@getElement')->name('tertulis.getElement');
            Route::post('tertulis/getKUK', 'TertulisController@getKUK')->name('tertulis.getKUK');
            Route::get('tertulis/{tertulis}/delete', 'TertulisController@delete')->name('tertulis.delete');
            Route::get('tertulis/{tertulis}/show', 'TertulisController@show')->name('tertulis.show');
            Route::get('tertulis/{tertulis}/edit', 'TertulisController@edit')->name('tertulis.edit');
            Route::get('lisan/data1', 'LisanController@Getdata')->name('tertulis.data');

            Route::resource('lisan', 'LisanController');
            Route::post('lisan/create', 'LisanController@create')->name('lisan.create');
            Route::post('lisan/data', 'LisanController@Getdata')->name('lisan.getdata');
            Route::get('lisan/{lisan}/delete', 'LisanController@delete')->name('lisan.delete');
            Route::post('lisan/update/{lisan}', 'LisanController@update')->name('lisan.update');
            Route::get('lisan/{lisan}/show', 'LisanController@show')->name('lisan.show');
            Route::get('lisan/{lisan}/edit', 'LisanController@edit')->name('lisan.edit');
            Route::post('lisan/getElement', 'LisanController@getElement')->name('lisan.getElement');
            Route::post('lisan/getKUK', 'LisanController@getKUK')->name('lisan.getKUK');

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
            Route::get('management/{program_id}/sebaran_soal', 'CBT\ManagementController@edit_komposisi_soal')->name('management.sebaran_soal');

            Route::group(['prefix' => 'materi'], function () {
                Route::get('soal', 'CBT\Materi\PembuatanSoalController@index')->name('materi.pembuatan-soal');
                Route::get('soal/data', 'CBT\Materi\PembuatanSoalController@AjaxPembuatanSoalGetData')->name('materi.pembuatan-soal.data');
                Route::post('soal/modul', 'CBT\Materi\PembuatanSoalController@AjaxGetSubmodul')->name('materi.pembuatan-soal.modul');
                Route::post('soal/id', 'CBT\Materi\PembuatanSoalController@AjaxGetId')->name('materi.pembuatan-soal.findId');
                Route::post('soal/insert', 'CBT\Materi\PembuatanSoalController@AjaxPembuatanSoalInsertData')->name('materi.pembuatan-soal.insert');
                Route::post('soal/parent', 'CBT\Materi\PembuatanSoalController@AjaxGetParent')->name('materi.pembuatan-soal.parent');
                Route::post('soal/delete', 'CBT\Materi\PembuatanSoalController@AjaxPembuatanSoalDeleteData')->name('materi.pembuatan-soal.delete');
                Route::get('soal/{soal}/show', 'CBT\Materi\PembuatanSoalController@show')->name('materi.pembuatan-soal.show');
                Route::get('soal/{soal}/edit', 'CBT\Materi\PembuatanSoalController@show')->name('materi.pembuatan-soal.edit');


                Route::get('jenis', 'CBT\Materi\JenisSoalController@index')->name('materi.jenis-soal');
                Route::get('jenis/data', 'CBT\Materi\JenisSoalController@AjaxJenisSoalGetData')->name('materi.jenis-soal.data');
                Route::post('jenis/insert', 'CBT\Materi\JenisSoalController@AjaxJenisSoalInsertData')->name('materi.jenis-soal.insert');


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
                Route::get('jadwal/submodul', 'CBT\Ujian\JadwalController@ajax_get_modsub')->name('ujian.jadwal.submodul');
                Route::get('jadwal/peserta', 'CBT\Ujian\JadwalController@ajax_get_peserta')->name('ujian.jadwal.peserta');
                Route::post('jadwal/peserta_store', 'CBT\Ujian\JadwalController@ajax_insert_peserta')->name('ujian.jadwal.peserta_store');
                Route::get('jadwal/pengawas', 'CBT\Ujian\JadwalController@ajax_get_pengawas')->name('ujian.jadwal.pengawas');
                Route::get('jadwal/print/{jadwal_id}', 'CBT\Ujian\JadwalController@ajax_print_perdana')->name('ujian.jadwal.print');
                Route::get('jadwal/create', 'CBT\Ujian\JadwalController@create')->name('ujian.jadwal.create');
                Route::get('jadwal/data', 'CBT\Ujian\JadwalController@AjaxJadwalGetData')->name('ujian.jadwal.data');
                Route::post('jadwal/insert', 'CBT\Ujian\JadwalController@AjaxJadwalInsertData')->name('ujian.jadwal.insert');
                Route::post('jadwal/pengawas_store', 'CBT\Ujian\JadwalController@ajax_insert_pengawas')->name('ujian.jadwal.pengawas_store');
                Route::post('jadwal/submodul_store', 'CBT\Ujian\JadwalController@ajax_insert_modsub')->name('ujian.jadwal.submodul_store');
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

                Route::get('aktivasi', 'CBT\Ujian\AktivasiController@index')->name('ujian.aktivasi');
                Route::get('aktivasi/peserta', 'CBT\Ujian\AktivasiController@ajax_get_peserta')->name('ujian.aktivasi.peserta');
                Route::get('aktivasi/data', 'CBT\Ujian\AktivasiController@data')->name('ujian.aktivasi.data');
                Route::post('aktivasi/insert', 'CBT\Ujian\AktivasiController@insert')->name('ujian.aktivasi.insert');
                Route::get('aktivasi/{ujian_parameter_id}/delete', 'CBT\Ujian\AktivasiController@delete')->name('ujian.aktivasi.delete');
                Route::get('aktivasi/{ujian_parameter_id}/edit', 'CBT\Ujian\AktivasiController@edit')->name('ujian.aktivasi.edit');
                Route::get('aktivasi/{ujian_parameter_id}/show', 'CBT\Ujian\AktivasiController@show')->name('ujian.aktivasi.show');

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

        Route::group(['prefix'=>'manajemen-kelas'], function () {
            Route::resource('jadwal-kelas', 'JadwalKelasController');
            Route::post('jadwal-kelas/getdata', 'JadwalKelasController@getJadwalKelasData')->name('jadwal-kelas.getdata');
            Route::get('jadwal-kelas/{jadwal_kelas}/delete', 'JadwalKelasController@delete')->name('jadwal-kelas.delete');

            /** Approve Jadwal Kelas */
            Route::get('jadwal-kelas/approve/index', 'JadwalKelasController@approveIndex')->name('jadwal-kelas.approve.index');
            Route::get('jadwal-kelas/approve/{jadwal_kelas}/view', 'JadwalKelasController@approveView')->name('jadwal-kelas.approve.view');
            Route::post('jadwal-kelas/approve/getdata', 'JadwalKelasController@getJadwalKelasNotApproveData')->name('jadwal-kelas.approve.getdata');
            Route::get('jadwal-kelas/approve/{jadwal_kelas}/setapprove/{status}', 'JadwalKelasController@approveJadwalKelas')->name('jadwal-kelas.approve.set-approve');

            /** Publish Jadwal Kelas */
            Route::get('jadwal-kelas/publish/index', 'JadwalKelasController@publishIndex')->name('jadwal-kelas.publish.index');
            Route::get('jadwal-kelas/publish/{jadwal_kelas}/view', 'JadwalKelasController@publishView')->name('jadwal-kelas.publish.view');
            Route::post('jadwal-kelas/publish/getdata', 'JadwalKelasController@getJadwalKelasNotPublishData')->name('jadwal-kelas.publish.getdata');
            Route::get('jadwal-kelas/publish/{jadwal_kelas}/setapprove/{status}', 'JadwalKelasController@publishJadwalKelas')->name('jadwal-kelas.publish.set-approve');

            /** Penutupan Pendaftaran Kelas */
            Route::get('jadwal-kelas/register/index', 'JadwalKelasController@registerIndex')->name('jadwal-kelas.register.index');
            Route::get('jadwal-kelas/register/{jadwal_kelas}/view', 'JadwalKelasController@registerView')->name('jadwal-kelas.register.view');
            Route::post('jadwal-kelas/register/getdata', 'JadwalKelasController@getJadwalKelasNotCloseRegisterData')->name('jadwal-kelas.register.getdata');
            Route::get('jadwal-kelas/register/{jadwal_kelas}/setapprove/{status}', 'JadwalKelasController@registerJadwalKelas')->name('jadwal-kelas.register.set-approve');
        });

        Route::group(['prefix'=>'manajemen-asssessmen'], function () {
            /** Pengaturan Kompetensi */
            Route::resource('pengaturan-kompetensi', 'PengaturanKompetensiController');
            Route::post('pengaturan-kompetensi/getdata', 'PengaturanKompetensiController@getPengaturanKompetensiData')->name('pengaturan-kompetensi.getdata');
            Route::get('pengaturan-kompetensi/{pengaturan_kompetensi}/delete', 'PengaturanKompetensiController@delete')->name('pengaturan-kompetensi.delete');
            Route::post('pengaturan-kompetensi/getprogramunitkompetensi', 'PengaturanKompetensiController@getProgramUnitKompetensi')->name('pengaturan-kompetensi.getunitkompetensi');

            /** Pre Assessment Modul */
            Route::get('pre-assessment','PreAssessmentController@index')->name('pre-assessment.index');
            Route::post('pre-assessment/getdata','PreAssessmentController@getPreAssessmentData')->name('pre-assessment.getdata');
            Route::get('pre-assessment/{jadwal_kelas}/view-allpeserta','PreAssessmentController@viewAllPeserta')->name('pre-assessment.viewallpeserta');
            Route::get('pre-assessment/{member_certification}/view-singlepeserta','PreAssessmentController@viewSinglePeserta')->name('pre-assessment.viewsinglepeserta');
            Route::post('pre-assessment/{member_certification}/send-chat-apl02','PreAssessmentController@saveChatApl02')->name('pre-assessment.savechatapl02');
            Route::get('pre-assessment/{member_certification}/approve-apl02/{status}','PreAssessmentController@approveAPL02')->name('pre-assessment.approveapl02');
            Route::post('pre-assessment/{member_certification}/save-paap','PreAssessmentController@savePaap')->name('pre-assessment.savepaap');

            /** Modul Asesmen */
            Route::get('asesmen', 'AssessmentController@index')->name('asesmen.index');
            Route::post('asesmen/getdata', 'AssessmentController@getAssessmentData')->name('asesmen.getdata');
            Route::get('asesmen/{jadwal_kelas}/view-allpeserta','AssessmentController@viewAllPeserta')->name('asesmen.viewallpeserta');
            Route::get('asesmen/{member_certification}/view-singlepeserta','AssessmentController@viewSinglePeserta')->name('asesmen.viewsinglepeserta');
        });
    });

//    Route::group(['namespace' => 'ManajemenPeserta', 'prefix' => 'management-peserta'], function () {
//        Route::group(['prefipostx' => 'peserta'], function () {
//            Route::get('peserta', 'MemberController@index')->name('peserta.pendaftaran');
//            Route::get('peserta/data', 'MemberController@getPesertaData')->name('peserta.pendaftaran.data');
//            Route::get('peserta/sertifikasi', 'MemberController@APL01')->name('peserta.pendaftaran.sertifikasi');
//            Route::get('peserta/sertifikasi/apl01/data', 'MemberController@getAPL01Data')->name('peserta.pendaftaran.sertifikasi.data');
//            Route::get('peserta/sertifikasi/apl01/view/{token}', 'MemberController@viewAPL01')->name('peserta.pendaftaran.sertifikasi.apl01');
//            Route::get('peserta/sertifikasi/pembayaran', 'MemberController@viewPaymentList')->name('peserta.pendaftaran.sertifikasi.pembayaran');
//            Route::get('peserta/sertifikasi/pembayaran/confirm/{id}', 'MemberController@verifyAPL01Payment')->name('peserta.pendaftaran.sertifikasi.pembayaran.confirm');
//            //Route::get('peserta/sertifikasi/pembayaran/confirm/{id}', 'MemberController@verifyAPL01Payment');
//            Route::get('peserta/sertifikasi/pembayaran/data', 'MemberController@getPaymentData')->name('peserta.pendaftaran.sertifikasi.pembayaran.data');
//            Route::put('peserta/sertifikasi/apl01/verify', 'MemberController@verifyAPL01');
//        });
//    });

    Route::group(['namespace' => 'ManajemenPeserta', 'prefix' => 'management-peserta'], function () {
        Route::group(['prefipostx' => 'peserta'], function () {
            Route::get('peserta', 'MemberController@index')->name('peserta.pendaftaran');
            Route::get('peserta/email/{token}', 'MemberController@sendVerificationEmail')->name('peserta.email');
            Route::get('peserta/data', 'MemberController@getPesertaData')->name('peserta.pendaftaran.data');
            Route::get('peserta/sertifikasi', 'MemberController@APL01')->name('peserta.pendaftaran.sertifikasi');
            Route::get('peserta/sertifikasi/apl01/data', 'MemberController@getAPL01Data')->name('peserta.pendaftaran.sertifikasi.data');
            Route::get('peserta/sertifikasi/apl01/view/{token}', 'MemberController@viewAPL01')->name('peserta.pendaftaran.sertifikasi.apl01');
            Route::get('peserta/sertifikasi/pembayaran', 'MemberController@viewPaymentList')->name('peserta.pendaftaran.sertifikasi.pembayaran');
            Route::put('peserta/sertifikasi/pembayaran', 'MemberController@sendPaymentEmail');
            Route::get('peserta/sertifikasi/pembayaran/confirm/{id}', 'MemberController@verifyAPL01Payment')->name('peserta.pendaftaran.sertifikasi.pembayaran.confirm');
            //Route::get('peserta/sertifikasi/pembayaran/confirm/{id}', 'MemberController@verifyAPL01Payment');
            Route::get('peserta/sertifikasi/pembayaran/data', 'MemberController@getPaymentData')->name('peserta.pendaftaran.sertifikasi.pembayaran.data');
            Route::put('peserta/sertifikasi/apl01/verify', 'MemberController@verifyAPL01');
            Route::put('peserta/sertifikasi/apl01/reject', 'MemberController@rejectAPL01');
        });

        Route::group(['prefix'=>'pendaftaran'], function (){
            Route::get('pemilihan-asesor', 'PendaftaranController@pemilihanAsesorIndex')->name('pendaftaran.pemilihanasesor');
            Route::post('pemilihan-asesor/getdata', 'PendaftaranController@getPemilihanAsesorData')->name('pendaftaran.pemilihanasesor.getdata');
            Route::get('pemilihan-asesor/{jadwal_kelas}/view-allpeserta', 'PendaftaranController@viewAllPeserta')->name('pendaftaran.viewallpeserta');
            Route::get('pemilihan-asesor/{member_certification}/set-asesor','PendaftaranController@setAsesor')->name('pendaftaran.pemilihanasesor.setasesor');
            Route::post('pemilihan-asesor/{member_certification}/save-asesor', 'PendaftaranController@saveAsesor')->name('pendaftaran.pemilihanasesor.saveasesor');
        });
    });
});
