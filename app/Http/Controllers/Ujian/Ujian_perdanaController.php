<?php
namespace App\Http\Controllers\Ujian;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Route;
use Url;
use Auth;
use Lang;
use EncryptionSoal;
use Cookie;
use DB;
use Mail;
use Crypt;
use App\Models\StartUjian\Peserta_jawab;
use App\Models\StartUjian\Perdana_peserta;
use App\Models\Ujian\Ujian_batch;
use App\Models\Program;
use App\Models\Ujian\Ujian_modul;
use App\Models\Soal;
use App\Models\StartUjian\Soal_peserta;
use App\Models\ProgramSchedule;
use App\Models\Users;
use App\Models\Ujian\Ujian;
use App\Models\StartUjian\Ujian_detail;
use App\Models\Peserta_lulus;
use App\Models\StartUjian\Waktu_persoal;
use App\Models\StartUjian\Waktu_ujian;
use App\Models\StartUjian\Waktu_sisa_perdana;
use App\Models\email_template\Konfirmasi;
use App\Models\email_template\Config_email;
class Ujian_perdanaController extends Controller
{
    public function index(Request $request, $batch_id)
    {
        $peserta_id             = \Auth::user()->id;
        $emp_id                 = $request->emp_id;
        $peserta                = \Auth::user()->name;
        $tanggal                = date("d-m-Y");
        $raw             = ProgramSchedule::with('programs')->where('id', $batch_id)->first();
        $nama_batch = $raw->programs->name;
        $ujian_batch_id         = Ujian_batch::where('program_schedule_id', $batch_id)->pluck('ujian_batch_id');
        $perdana_peserta        = Perdana_peserta::where('peserta_id', $peserta_id)
                                                ->whereIn('ujian_batch_id', $ujian_batch_id)
                                                ->first();
        $waktu_sisa             = DB::table('waktu_ujian')
                                    ->where('perdana_peserta_id', $perdana_peserta->perdana_peserta_id)
                                    ->first();
        if($waktu_sisa){
            $waktu = $waktu_sisa->sisa_waktu;
        } else {
            $waktu              = DB::table('waktu_persoal')->where('batch_id', $batch_id)->value('durasi_ujian');    
        }
        
        $check                  = Perdana_peserta::where('peserta_id', $peserta_id)
                                                 ->whereIn('ujian_batch_id', $ujian_batch_id)
                                                 ->where('aktivasi', false)->get();
                                               
                                                 
        // if($check->count() > 0) {
        //     return abort(404);
        // } else {
            $perdana_peserta_id     = Perdana_peserta::where('peserta_id', $peserta_id)->whereIn('ujian_batch_id', $ujian_batch_id)->pluck('perdana_peserta_id');
            $soal_peserta_id        = Soal_peserta::whereIn('perdana_peserta_id', $perdana_peserta_id)->pluck('soal_peserta_id');
            $modul_jawab            = Peserta_jawab::whereIn('soal_peserta_id', $soal_peserta_id)
                                                   ->select(['peserta_jawab.soal_id', 'peserta_jawab.kunci_id', 'modul.name', 'modul.id'])
                                                   ->join('modul_soal', 'modul_soal.soal_id', 'peserta_jawab.soal_id')
                                                   ->join('modul', 'modul.id', 'modul_soal.modul_id')
                                                   ->inRandomOrder()
                                                   ->get()
                                                   ->groupBy('modul_id');
            $total_soal             = Peserta_jawab::whereIn('soal_peserta_id', $soal_peserta_id)->count();
            $string_soal_peserta_id = Soal_peserta::whereIn('perdana_peserta_id', $perdana_peserta_id)->value('soal_peserta_id');
            
            $ans = [];
            foreach ($modul_jawab as $value1) {
                foreach ($value1 as $value2) {
                    if($value2->kunci_id != null){ // cek database
                        array_push($ans, $value2->soal_id);
                    }
                }   
            }
            $string_perdana_peserta_id = Perdana_peserta::where('peserta_id', $peserta_id)->whereIn('ujian_batch_id', $ujian_batch_id)->value('perdana_peserta_id');
            // Menonaktifkan peserta
            Perdana_peserta::where('peserta_id', $peserta_id)->whereIn('ujian_batch_id', $ujian_batch_id)->update(['aktivasi'=>false]);
            // delete cookies hasil ujian
            //setcookie("hasil_ujian", "", TIME()- 3600,"/",\Config::get('APP_URL'));
            $keyboard_lock = $request->keyboard_lock;
            return view('sertifikasi.ujian_perdana.start_ujian', compact('peserta', 'tanggal', 'waktu', 'nama_batch', 'soal_peserta_id', 'cek_boleh_ujian', 'string_perdana_peserta_id', 'peserta_id', 'emp_id', 'keyboard_lock', 'ans', 'total_soal', 'perdana_peserta', 'modul_jawab'));
        // }
    }
    public function ajax_password_ulang(Request $request, $emp_id)
    {
        $emp_id            = $emp_id;
        $password_ulang    = $request->password_ulang;
        
        $password_pengawas = Users::where('emp_id', $emp_id)->value('password');
            if(\Hash::check($password_ulang, $password_pengawas))
            {
                return response()->json([
                    'pesan'=>'berhasil'
                ]);
            }
            else
            {
                return response()->json([
                    'pesan'=>'gagal'
                ]);
            }
    }
    public function ajax_save_peserta_jawab(Request $request)
    {
        $soal_id              = $request->soal_id;
        $kunci_id             = $request->kunci_id;
        $soal_peserta_id      = $request->soal_peserta_id;
        $perdana_peserta_id   = $request->perdana_peserta_id;
        $time                 = $request->time;
        $kunci_id_master      = Soal::where('soal_id', $soal_id)->value('kunci_id');
        
        $check_peserta_jawab  = Peserta_jawab::whereIn('soal_peserta_id', $soal_peserta_id)->where('soal_id', $soal_id)->get();
        $jumlah_peserta_jawab = count($check_peserta_jawab);
        DB::beginTransaction();
            $success_trans = false;
            try {
                $check_waktu = Waktu_ujian::where('perdana_peserta_id', $perdana_peserta_id)->first();
                if($check_waktu){
                    Waktu_ujian::where('perdana_peserta_id', $perdana_peserta_id)->update(['sisa_waktu'=> $time]);
                } else {
                    $waktu_ujian                     = new Waktu_ujian;
                    $waktu_ujian->perdana_peserta_id = $perdana_peserta_id;
                    $waktu_ujian->sisa_waktu         = $time;
                    $waktu_ujian->save();
                }
                
                if($jumlah_peserta_jawab > 0){
                    foreach ($check_peserta_jawab as $cpj) {
                        $new_cpj = Peserta_jawab::where('soal_peserta_id', $cpj->soal_peserta_id)->where('soal_id', $cpj->soal_id)->first();
                        $new_cpj->kunci_id = $kunci_id;
                        if($kunci_id == $kunci_id_master){
                            $new_cpj->is_bener = true;
                        }else{
                            $new_cpj->is_bener = false;
                        }
                        $new_cpj->save();
                    }
                }else{
                    foreach ($soal_peserta_id as $spi) {
                        $peserta_jawab                  = new Peserta_jawab;
                        $peserta_jawab->soal_peserta_id = $spi;
                        $peserta_jawab->soal_id         = $soal_id;
                        $peserta_jawab->kunci_id        = $kunci_id;
                        if($kunci_id == $kunci_id_master){
                            $new_cpj->is_bener = true;
                        }else{
                            $new_cpj->is_bener = false;
                        }
                        $peserta_jawab->save();
                    }
                }
            DB::commit();
            $success_trans = true;
        } catch (\Exception $e) {
            DB::rollback();
            // error page
            abort(403, $e->getMessage());
        }
        if($success_trans == true){
            return response()->json([
                'check_peserta_jawab'=>$check_peserta_jawab,
                'soal_peserta_id'=>$soal_peserta_id,
                'soal_id'=>$soal_id
            ]);
        } else if($success_trans == false){
            return response()->json([
                'check_peserta_jawab'=>'',
                'soal_peserta_id'=>'',
                'soal_id'=>''
            ]);
        }
    }


    public function akhiri_ujian(Request $request)
    {
        $cookie_name = 'nilai';
        if(!isset($_COOKIE[$cookie_name])) {
          $nilai_ujian = '100';
        } else {
          $nilai_ujian = $_COOKIE[$cookie_name];
        }
    
        return view('sertifikasi.ujian_perdana.akhiri_ujian', compact('nilai_ujian'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ujian           = Peserta_jawab::where('soal_peserta_id', $id)->get();
        $soal_peserta_id = $id;
        $total_soal      = count($ujian);
        return view('sertifikasi.ujian_perdana.ujian_show', compact('ujian', 'soal_peserta_id', 'total_soal'));
    }
    public function start_ujian($id)
    {
        $ujian = Peserta_jawab::where('soal_peserta_id', $id)->paginate(1);
        return view('sertifikasi.ujian_perdana.start_ujian', compact('ujian'));
    }

    public function print_ujian()
    {
        $data['hasil_ujian'] = json_decode($_COOKIE['hasil_ujian'], true);
        $pdf = \PDF::loadView('sertifikasi.print_hasil_ujian', $data);
        return $pdf->stream('sertifikasi.pdf', array('Attachment' => false));
    }

    public function ajax_persentase_kelulusan(Request $request)
    {
        $soal_peserta_id    = array_unique($request->soal_peserta_id);
       
        $temp               = 0;
        $all_spi            = collect();
        $data               = [];
         DB::beginTransaction();
            $success_trans = false;
            try {
                // mengisi nilai persentase kelulusan di table soal_peserta
                foreach ($soal_peserta_id as $key => $spi) {
                    $all_spi->push($spi);
                    $soal_peserta = Soal_peserta::where('soal_peserta_id', $spi)->first();
                    // $soal_peserta = Soal_peserta::with('ujian_modul.batch_modul')->where('soal_peserta_id', $spi)->first();
                    $soal_peserta->persentase_kelulusan = $soal_peserta->ujian_modul->batch_modul->persentase_kelulusan_modul;
                   
                    // get soal_peserta_id with same modul_id
                    $ujian_modul_id        = $soal_peserta->ujian_modul_id;
                    $modul_id              = Ujian_modul::find($ujian_modul_id)->modul_id;
                    $ujian_batch_id        = Ujian_modul::find($ujian_modul_id)->ujian_batch_id;
                    $per_modul             = Ujian_modul::where('ujian_batch_id', $ujian_batch_id)->where('modul_id', $modul_id)->pluck('ujian_modul_id');
                    $soal_pesertas         = Soal_peserta::whereIn('soal_peserta_id', $soal_peserta_id)
                                                         ->whereIn('ujian_modul_id', $per_modul)
                                                         ->pluck('soal_peserta_id');
                    $total_soal_modul      = Peserta_jawab::whereIn('soal_peserta_id', $soal_pesertas)->count();
                    $total_benar_modul     = Peserta_jawab::whereIn('soal_peserta_id', $soal_pesertas)->where('is_bener', true)->count();
                    $persentase_kelulusan  = $soal_peserta->ujian_modul->batch_modul->persentase_kelulusan_modul;
                    (float)$nilai_modul    = @((float)$total_benar_modul / (float)$total_soal_modul) * 100;
                    $fix_persentase         = floor($nilai_modul);
                    if($fix_persentase < $persentase_kelulusan)
                    {
                        $is_lulus = false;
                    }else{
                        $is_lulus = true;
                    }
                        // update tbl:soal_peserta
                        $soal_peserta->nilai_ujian          = $fix_persentase;
                        $soal_peserta->persentase_kelulusan = $persentase_kelulusan;
                        $soal_peserta->is_lulus             = $is_lulus;
                        $soal_peserta->nilai                = $total_benar_modul;
                        $soal_peserta->save();
                /*
                    data untuk print hasil ujian
                */
                $peserta_id   = Auth::user()->id;
                $nama_peserta = Auth::user()->name; 
                $tgl_lahir    = \Helper::date_formats(Auth::user()->tanggal_lahir, 'view'); 
                
                $ujian_batch  = DB::table('ujian_batch')->where('ujian_batch_id', $ujian_batch_id)->first();
                // return response()->json($ujian_batch);exit;
                $batch        = ProgramSchedule::with('programs')->where('id', $ujian_batch->program_schedule_id)->first();
                $program      = DB::table('programs')->where('id', $batch->program_id)->first();
                
                $reg_wppe   = DB::table('pendaftaran')->where('peserta_id', $peserta_id)->where('batch_id', $batch->id)->whereNotNull('no_reg_wppe')->value('no_reg_wppe');
                /*
                    end data
                */
                
                /*
                    data untuk insert tbl:perdana_trx
                */
                $perdana_jadwal = DB::table('perdana_jadwal')
                                                   ->where('perdana_jadwal_id', function($q) use($ujian_batch_id){
                                                        $q->select('perdana_jadwal_id')
                                                          ->from('ujian_batch')
                                                          ->where('ujian_batch_id', $ujian_batch_id);
                                                   })->first();
                $modul = Ujian_modul::select(['ujian_modul.modul_id'])->where('ujian_batch_id', $ujian_batch_id)->distinct()->get();
                
                if($key == 0){
                    /* Insert table ujian */
                    $ujian               = new Ujian;
                   
                    $ujian->program_id     = $batch->program_id;
                    
                    $ujian->name   = $batch->programs->name;
                    $ujian->peserta_id   = $peserta_id;
                    $ujian->member_name = $nama_peserta;
                    $ujian->created_at = date('Y-m-d H:i:s');
                    $ujian->save();
                }
                foreach ($modul as $value) {
                    if($modul_id != $temp)
                    {
                        
                        $tuk     = DB::table('competence_places')->where('id', $batch->competence_place_id)->first();
                       
                        // $cabang = DB::table('cabang')->where('cabang_id', $kp->cabang_id)->first();
                        // $lokasi = DB::table('lokasi')->where('lokasi_id', $cabang->lokasi_id)->first();
                        /* Insert table detail ujian */
                        $ujian_dtl                       = new Ujian_detail;
                        $ujian_dtl->ujian_id             = $ujian->ujian_id;
                        $ujian_dtl->perdana_jadwal_id    = $perdana_jadwal->perdana_jadwal_id;
                        // $ujian_dtl->ulang_jadwal_id      = null;
                        $ujian_dtl->nama_ujian           = $perdana_jadwal->name;
                       
                        $ujian_dtl->tgl_ujian            = $perdana_jadwal->tgl_perdana;
                        $ujian_dtl->modul_id             = $modul_id;
                        $ujian_dtl->nama_modul          = DB::table('modul')->where('id', $modul_id)->value('name');
                        $ujian_dtl->nilai                = $fix_persentase;
                        // $ujian_dtl->lokasi               = $lokasi->nama;
                        // $ujian_dtl->cabang               = $cabang->nama;
                        
                        $ujian_dtl->kp                   = $tuk->name;
                        $ujian_dtl->status_ujian         = $is_lulus == true ? 'Lulus' : 'Gagal';
                        $ujian_dtl->persentase_kelulusan = $persentase_kelulusan;
                        $ujian_dtl->is_pengawas          = $perdana_jadwal->is_pengawas;
                        if($perdana_jadwal->is_pengawas == true){
                            $pengawas = DB::table('employee')->where('emp_id', $perdana_jadwal->emp_id)->first();
                            $ujian_dtl->nama_pengawas = $pengawas->first_name.' '.$pengawas->middle_name.' '.$pengawas->last_name;
                        }
                        $ujian_dtl->save();
                        // insert to tbl:perdana_trx
                        // $perdana_trx               = new Perdana_trx;
                        // $perdana_trx->nama_perdana = $perdana_jadwal->nama;
                        // $perdana_trx->tgl_perdana  = $perdana_jadwal->tgl_perdana;
                        // $perdana_trx->nama_peserta = $nama_peserta;
                        // $perdana_trx->nama_batch   = $batch->nama;
                        // $perdana_trx->nama_modul   = DB::table('modul')->where('modul_id', $modul_id)->value('nama');
                        // $perdana_trx->nilai        = $fix_persentase;
                        // $perdana_trx->is_pengawas  = $perdana_jadwal->is_pengawas;
                        
                        // if($perdana_jadwal->is_pengawas == true){
                        //     $pengawas = DB::table('employee')->where('emp_id', $perdana_jadwal->emp_id)->first();
                        //     $perdana_trx->nama_pengawas = $pengawas->first_name.' '.$pengawas->middle_name.' '.$pengawas->last_name;
                        // }
                        // $perdana_trx->persentase_kelulusan = $persentase_kelulusan;
                        // $perdana_trx->status_ujian         = $is_lulus == true ? 'Lulus' : 'Gagal';
                        // $perdana_trx->peserta_id           = Auth::user()->peserta_id;
                        // $perdana_trx->batch_id             = $batch->batch_id;
                        // $perdana_trx->modul_id             = $modul_id;
                        // $perdana_trx->save();
                    }
                    $temp = $modul_id;
                    // end insert
                    // push data hasil ujian
                   $arr['nama_modul']    = DB::table('modul')->where('id', $modul_id)->value('name');
                   $arr['nama_program']  = $program->name;
                   $arr['singkatan_ind'] = $program->abbreviation_id;
                   $arr['singkatan_eng'] = $program->abbreviation_en;
                   $arr['nama_peserta']  = Auth::user()->name; 
                //    $arr['tgl_lahir']     = $tgl_lahir;
                   $arr['reg_wppe']      = $reg_wppe;
                   $arr['total_soal']    = $total_soal_modul;
                   $arr['total_benar']   = $total_benar_modul;
                   $arr['nilai']         = $fix_persentase;
                   $arr['lulus']         = $is_lulus;
                   array_push($data, $arr);
                } // end foreach modul
            } // end foreach soal_peserta_id
            /* Create data & insert waktu sisa ujian */
            $sisa_soal  = 0;
            $modul_soal = array_unique($data, SORT_REGULAR);
            foreach ($modul_soal as $value) {
                // jumlahkan sisa soal dari modul yang gagal
                if($value['lulus'] == false){
                    $sisa_soal += $value['total_soal'];
                }
            }
           
            $waktu_persoal             = Waktu_persoal::where('batch_id', $batch->id)->first();
            
            $waktu_sisa                = new Waktu_sisa_perdana;
            $waktu_sisa->batch_id      = $batch->id;
            $waktu_sisa->peserta_id    = $peserta_id;
            $waktu_sisa->sisa_soal     = $sisa_soal;
            $waktu_sisa->waktu_persoal = $waktu_persoal->waktu_persoal;
            $waktu_sisa->sisa_waktu    = round($sisa_soal*$waktu_persoal->waktu_persoal);
            $waktu_sisa->date_created  = date('Y-m-d H:i:s');
            $waktu_sisa->save();
            $gagal = Soal_peserta::whereIn('soal_peserta_id', $all_spi)->where('is_lulus', false)->count();
            // jika tidak ada modul yang gagal / semua modul lulus
            if($gagal < 1) {
                // lihat no sertifikat terbesar berdasarkan kode program di old siak
                $old_sertifikat = DB::connection('mysql')
                                ->table('t_admisi')
                                ->where('kd_program', $program->program_id)
                                ->where('nip', '!=', '0')
                                ->max('nip');
                $old_sertifikat = str_pad($old_sertifikat, 6, 0, STR_PAD_LEFT);
                // cari no sertifikat terbesar berdasarkan kode program
                $no            = Peserta_lulus::where('no_sertifikat', 'like', $program->kode.'%')->max('no_sertifikat');
                $char          =  '-';
                $strpos        = strpos($no, $char); 
                $highest       = substr($no, $strpos + strlen($char)); 
                if($old_sertifikat > $highest){
                    $highest = $old_sertifikat;
                }
                $no_sertifikat = str_pad($highest + 1, 6, 0, STR_PAD_LEFT);
                $profile       = DB::table('profile_peserta')->where('peserta_id', Auth::user()->peserta_id)->first();
                // insert to tbl:peserta_lulus
                $pl                  = new Peserta_lulus;
                $pl->peserta_id      = Auth::user()->peserta_id;
                $pl->batch_id        = $batch->batch_id;
                $pl->nama_batch      = $batch->name;
                $pl->no_sertifikat   = $program->kode.'-'.$no_sertifikat;
                $pl->nama_peserta    = Auth::user()->name;
                $pl->nama_program    = $program->name;
                $pl->singkatan_ind   = $program->singkatan_ind;
                $pl->singkatan_eng   = $program->singkatan_eng;
                $pl->email           = Auth::user()->email;
                $pl->tempat_lahir    = $profile->tempat_lahir;
                $pl->photo           = $profile->photo;
                $pl->tgl_lahir       = Auth::user()->tanggal_lahir;
                $pl->tgl_lulus       = date('Y-m-d');
                $pl->date_created    = date('Y-m-d H:i:s');
                // $pl->nama_lokasi     = DB::table('lokasi')->where('lokasi_id', $profile->lokasi_id)->value('nama');
                // $pl->nama_lembg_pdkn = DB::table('lembg_pdkn')->where('lembg_pdkn_id', $profile->lembg_pdkn_id)->value('nama');
                // $pl->lembg_pdkn_id   = DB::table('lembg_pdkn')->where('lembg_pdkn_id', $profile->lembg_pdkn_id)->value('lembg_pdkn_id');
                // $pl->nama_cabang     = DB::table('cabang')->where('cabang_id', function($q) use($profile){
                //                             $q->select('cabang_id')
                //                               ->from('lembg_pdkn')
                //                               ->where('lembg_pdkn_id', $profile->lembg_pdkn_id);
                //                         })->value('nama');
                $pl->save();
                /** Send email verifikasi data sertifikat kelulusan **/
                $header          = 'email-template.core.header';
                $footer          = 'email-template.core.footer';
                $config          = Config_email::first();
                $konfirmasi      = Konfirmasi::find(14);
                $peserta         = DB::table('peserta')->where('peserta_id', $peserta_id)->first();
                 Mail::send('email-template.email-konfirmasi-sertifikat', 
                    [   'header'        => $header, 
                        'footer'        => $footer, 
                        'config'        => $config, 
                        'konfirmasi'    => $konfirmasi, 
                        'peserta'       => $peserta,
                        'link'          => url('profile/konfirmasi_sertifikat/' . Crypt::encrypt($peserta->peserta_id)). '/' . Crypt::encrypt($batch->batch_id)
                    ],
                    function ($message) use ($peserta){
                        $message->subject(' TICMI - Verifikasi Data Sertifikat');
                        $message->from('mg@ticmi.co.id', 'TICMI');
                        $message->to($peserta->email);
                    }
                );
            }
            
            DB::commit();
            $success_trans = true;
        } catch (\Exception $e) {
            DB::rollback();
            // error page
            abort(403, $e->getMessage());
        }
        
        if($success_trans == true){
            $json = array_unique($data, SORT_REGULAR);
            setcookie("hasil_ujian", json_encode($json), 0, '/');
            echo json_encode($json);
        }else if($success_trans == false){
            $json = 'failed';
            echo json_encode($json);
        }
    }
}