<?php

namespace App\Http\Controllers\ManajemenAssessmen\CBT\Ujian;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\Ujian\Aktivasi;
use App\Models\Ujian\Ujian_batch;
use App\Models\Ujian\Ujian_modul;
use App\Models\Ujian\Jadwal;
use App\Models\Ujian\Perdana;
use App\Models\Ujian\Jenis;
use App\Models\StartUjian\Soal_peserta;
use App\Models\StartUjian\Perdana_peserta;
use App\Models\TUK;
use App\Models\ProgramSchedule;
use App\Models\MemberCertification ;
use DataTables;
use Entrust;
use DB;
use Lang;
use Carbon\Carbon;



class AktivasiController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:Ujian Aktivasi']);
    }

    public function index()
    {
		return view('ManajemenAssessmen.cbt.ujian.AktivasiController.index');
    }

    public function ajax_get_peserta(Request $request){
        if($request->ajax()){
            $jadwal_id = $request->jadwal_id;
            
            // ---------------------------------------------
            // get 'all batch and not in ujian_batch' 
            $batch_peserta = array();
            $batch_in_ujian = Ujian_batch::select(['ujian_batch.program_schedule_id', 'ujian_batch.ujian_batch_id'])->where('perdana_jadwal_id', $jadwal_id)->get();
           
            foreach ($batch_in_ujian as $data) {
                $data_batch = ProgramSchedule::where('id', $data->program_schedule_id)->first();
                $arr['id_batch']       = $data_batch->id;
                $arr['nama_batch']     = $data_batch->programs->name;
                $arr['ujian_batch_id'] = $data->ujian_batch_id;
                $arr['peserta']        = array();

                
                $peserta_ids = Perdana_peserta::where('ujian_batch_id', $data->ujian_batch_id)
                                              ->where('aktivasi', false)
                                              ->whereNotIn('peserta_id', function($q) use($jadwal_id, $data){
                                                $q->select('peserta_id')
                                                  ->from('ujian')
                                                  ->where('program_id', $data->program_schedule_id)
                                                  ->whereIn('ujian_id', function($r) use($jadwal_id){
                                                    $r->select('ujian_id')
                                                      ->from('ujian_detail')
                                                      ->where('perdana_jadwal_id', $jadwal_id);
                                                  });
                                              })
                                              ->pluck('peserta_id');
                $data_peserta = MemberCertification::select(['member_certification.id', 'members.name', 'members.email'])
                ->join('members', 'members.id', '=', 'member_certification.member_id')
                ->whereIn('member_certification.id', $peserta_ids)->get();

                foreach ($data_peserta as $value) {
                    $arrp = array();
                    $arrp['peserta_id']  = $value->id;
                    $arrp['nama_peserta']  = $value->name;
                    $arrp['email_peserta'] = $value->email;
                    array_push($arr['peserta'], $arrp);
                }
                array_push($batch_peserta, $arr);
            }
            if(!empty($batch_peserta)){
                echo json_encode($batch_peserta);
            }else{
                echo json_encode(array());
            }
        }
    }

    public function data(Request $request)
    {
        
            $sql_no_urut    = \Yajra_datatable::get_no_urut('perdana.perdana_id', $request);
            $jadwal = DB::table('perdana_jadwal')
            ->select([
                    DB::raw($sql_no_urut), // nomor urut
                    'perdana_jadwal.perdana_jadwal_id AS perdana_jadwal_id',
                    'perdana_jadwal.name AS nama_perdana_jadwal',
                    'perdana_jadwal.tgl_perdana AS tgl_perdana',
                    'competence_places.name AS nama_ruang', 
                    'hari.name AS nama_hari',
                    'jam.name AS nama_jam',
                    // 'employee.first_name AS first_name',
                    // 'employee.middle_name AS middle_name',
                    // 'employee.last_name AS last_name',
                    ])
            ->join('hari', 'hari.hari_id', '=', 'perdana_jadwal.hari_id')
            ->join('jam', 'jam.jam_id', '=', 'perdana_jadwal.jam_id')
            //->join('employee', 'employee.emp_id', '=', 'perdana_jadwal.emp_id')
            ->join('perdana', 'perdana.perdana_id', '=', 'perdana_jadwal.perdana_id')
            ->join('competence_places', 'competence_places.id', '=', 'perdana.competence_places_id')
            ->whereDate('perdana_jadwal.tgl_perdana', '=' , date('Y-m-d'));
            
        
        return DataTables::of($jadwal)->addColumn('action', function ( $jadwal) {
           
            $action = '';
            if (auth()->user()->can('Tempat Uji Kompetensi (TUK) Edit')) {
                $action .= '<button id="edit" data-jadwal="'.$jadwal->perdana_jadwal_id.'"  class="btn btn-sm btn-clean btn-icon btn-icon-md aktivasi_peserta" title="Edit ' . $jadwal->nama_perdana_jadwal . '"><i class="flaticon2 flaticon2-pen"></i></button>';
          
            }
			return $action;
			
		})->make(true);
}
    

    public function delete(Request $request)
    {
       
        $deleted = Aktivasi::find($request->ujian_Aktivasi_id)->delete();
        if ($deleted) {
          
        } else {
            
        }

        return redirect()->route('ujian.Aktivasi');
    }

    

    public function insert(Request $request)
    {
        
        if ($request->ajax()) {
            $data = $request->data;
            // return $data; exit;
            DB::beginTransaction();
            $success_trans = false;
            try {
                $arrsoal  = [];
                $arrjawab = [];
                /* 
                $data = batch_id
                           ujian_batch_id
                                peserta_id 
                */
                foreach($data as $ujian_batch) {
                   
                    if(array_key_exists('peserta', $ujian_batch))
                    {
                        
                        foreach($ujian_batch['peserta'] as $peserta) {
                            
                            $perdana_peserta_id = Perdana_peserta::where('ujian_batch_id', $ujian_batch['ujian_batch_id'])
                                                                  ->where('peserta_id', $peserta['peserta_id'])
                                                                  ->value('perdana_peserta_id');
                                                                
                            $batch_id           = Ujian_batch::find($ujian_batch['ujian_batch_id'])->program_schedule_id;
                            
                            $program_id         = ProgramSchedule::find($batch_id)->program_id;
                            // return $program_id;  exit;
                            // set aktivasi TRUE tbl:perdana_peserta
                            $soal_peserta_exist = Soal_peserta::where('perdana_peserta_id', $perdana_peserta_id)->exists();
                            
                            $update_perdana_peserta           =  Perdana_peserta::find($perdana_peserta_id);
                            $update_perdana_peserta->aktivasi = true;
                            $update_perdana_peserta->save();
                          
                            // if soal peserta have been booked then stop iteration (just set aktivasi 'TRUE' only)
                            if($soal_peserta_exist) {
                                continue;
                            }
                            
                            // get data ujian_modul
                            $data_ujian         = Ujian_modul::where('ujian_batch_id', $ujian_batch['ujian_batch_id'])->get();
                            
                            foreach($data_ujian as $ujian) {
                                // get program_dtl_id by modul_id & submodul_id & program_id
                                $program_dtl_id = Program_management::where('program_id', $program_id)
                                                                    ->where('modul_id', $ujian->modul_id)
                                                                    ->where('submodul_id', $ujian->submodul_id)
                                                                    ->where('hapus', FALSE)
                                                                    ->value('program_dtl_id');
                                // get komposisi soal
                                $komposisis     = Komposisi_soal::where('program_dtl_id', $program_dtl_id)
                                                                ->whereNotNull('jumlah_soal')
                                                                ->get();
                                $soal_peserta                     = new Soal_peserta;
                                $soal_peserta->ujian_modul_id     = $ujian->ujian_modul_id;
                                $soal_peserta->perdana_peserta_id = $perdana_peserta_id;
                                $soal_peserta->nilai_ujian        = null;
                                $soal_peserta->is_lulus           = null;
                                $soal_peserta->save();
                                $soal_peserta_id = $soal_peserta->soal_peserta_id;
                                                                
                                if(count($komposisis) > 0)
                                {
                                    foreach ($komposisis as $komposisi) {
                                        $kebutuhan  = $komposisi->jumlah_soal;
                                        // jika tidak membutuhkan soal (jumlah soal null) untuk jenis soal ini maka lewati perulangan
                                        if($kebutuhan === null) {
                                            continue;
                                        }
                                        $modul_soal = Modul_soal::where('modul_id', $ujian->modul_id)
                                                                        ->where('submodul_id', $ujian->submodul_id)
                                                                        ->pluck('soal_id');
                                        $bank_soal  = Pembuatan_soal::whereIn('soal_id', $modul_soal)
                                                                            ->where('aktif', TRUE)
                                                                            ->where('jenis_soal_id', $komposisi->jenis_soal_id)
                                                                            ->pluck('soal_id');
                                        $parents    = Pembuatan_soal::whereIn('soal_id', $bank_soal)
                                                                            ->where('aktif', TRUE)
                                                                            ->where('parent', '=', '0')
                                                                            ->inRandomOrder()
                                                                            ->pluck('soal_id');
                                        /* generate soal yang dibutuhkan sesuai jenis soalnya */
                                        $hasil_soal = collect();
                                        if($parents->count() >= $kebutuhan){
                                            for ($i = 1; $i <= $kebutuhan; $i++) {
                                                if($parents->count() > 1){
                                                    $parents_popped     = $parents->pop();
                                                    $family     = Pembuatan_soal::where('parent', $parents_popped)->pluck('soal_id')->push($parents_popped);
                                                    $family_shuffled   = $family->shuffle();
                                                    $family_popped     = $family_shuffled->pop();
                                                    $hasil_soal->push($family_popped);
                                                } else {
                                                    $hasil_soal->push($parents->pop());
                                                }
                                            }    
                                        } else {
                                            for ($i = 1; $i <= $kebutuhan; $i++) {
                                                if($parents->count() > 1){
                                                    $parents_popped    = $parents->pop();
                                                    $family            = Pembuatan_soal::where('parent', $parents_popped)->pluck('soal_id')->push($parents_popped);
                                                    $family_shuffled   = $family->shuffle();
                                                    $family_popped     = $family_shuffled->pop();
                                                    $hasil_soal->push($family_popped);
                                                }elseif($parents->count() == 0){
                                                    $new_parents    = Pembuatan_soal::whereIn('soal_id', $bank_soal)
                                                                    ->where('parent', '=', '0')
                                                                    ->where('aktif', TRUE)
                                                                    ->inRandomOrder()
                                                                    ->pluck('soal_id');
                                                    $sisa   = $kebutuhan - $hasil_soal->count();
                                                    $childs = Pembuatan_soal::whereIn('parent', $new_parents)->whereNotIn('soal_id',$hasil_soal)->inRandomOrder()->take($sisa)->pluck('soal_id');
                                                    foreach ($childs as $child) {
                                                        $hasil_soal->push($child);
                                                    }
                                                    break;
                                                } else {
                                                    $hasil_soal->push($parents->pop());
                                                }
                                            }
                                        }
                                        $hasil_soal = $hasil_soal->unique();
                                        // insert soal
                                        if($hasil_soal != null){
                                            if($hasil_soal->count() > 1){
                                                foreach ($hasil_soal as $value_soal) {
                                                    if(!empty($value_soal)){
                                                        // insert tabel:peserta_jawab
                                                        $peserta_jawab                  = new Peserta_jawab;
                                                        $peserta_jawab->soal_peserta_id = $soal_peserta_id;
                                                        $peserta_jawab->soal_id         = $value_soal;
                                                        $peserta_jawab->kunci_id        = null;
                                                        $peserta_jawab->is_bener        = null;
                                                        $peserta_jawab->nilai           = null;
                                                        $peserta_jawab->save();
                                                    }
                                                }
                                            } elseif (preg_match('/[\[\]\'^£$%&*()}{@#~?><>,|=_+¬-]/', $hasil_soal)){
                                                $hasil_soal = str_replace(array( '[', ']' ), '', $hasil_soal);
                                                if($hasil_soal != ''){
                                                    // insert tabel:peserta_jawab
                                                    $peserta_jawab                  = new Peserta_jawab;
                                                    $peserta_jawab->soal_peserta_id = $soal_peserta_id;
                                                    $peserta_jawab->soal_id         = $hasil_soal;
                                                    $peserta_jawab->kunci_id        = null;
                                                    $peserta_jawab->is_bener        = null;
                                                    $peserta_jawab->nilai           = null;
                                                    $peserta_jawab->save();
                                                }
                                            }
                                        }
                                        
                                        
                                    } // end foreach komposisi
                                } //end if komposisi count > 0
                            } // end foreach data ujian
                            
                            /** check table waktu_persoal apakah waktu untuk ujian ini sudah ada jika belum lakukan insert **/
                            $check_waktu = Waktu_persoal::where('batch_id', $batch_id)->first();
                            if(!$check_waktu){
                                $durasi_ujian = DB::table('ujian_parameter')
                                                  ->where('ujian_parameter_id', function($q) use($batch_id){
                                                    $q->select('ujian_parameter_id')
                                                      ->from('batch')
                                                      ->where('batch_id', $batch_id);
                                                  })
                                                  ->value('durasi_default_ujian');
                                $total_soal   = Peserta_jawab::whereIn('soal_peserta_id', function($q) use($perdana_peserta_id){
                                                                $q->select('soal_peserta_id')
                                                                  ->from('soal_peserta')
                                                                  ->where('perdana_peserta_id', $perdana_peserta_id);
                                                              })
                                                              ->count();
                                $waktu                   = new Waktu_persoal;
                                $waktu->batch_id         = $batch_id;
                                $waktu->durasi_ujian     = $durasi_ujian*60;
                                $waktu->nama_batch       = Batch::find($batch_id)->nama;
                                $waktu->total_soal_ujian = $total_soal;
                                $waktu->waktu_persoal    = $waktu->durasi_ujian/$total_soal;
                                $waktu->aktivasi         = TRUE;
                                $waktu->date_created     = date('Y-m-d H:i:s');
                                $waktu->user_created     = \Auth::id();
                                $waktu->save();
                            }
                        } // end foreach ujian batch
                    } // end if array ujian_batch key 'peserta' exist
                } // end foreach $data
             DB::commit();
             $success_trans = true;
            } catch (\Exception $e) {
                DB::rollback();
                    // error page
                abort(403, $e->getMessage());
            }
            if($success_trans == true){
                $json['status'] = Lang::get('db.updated');
            }else if($success_trans == false){
                $json['status'] = Lang::get('db.failed_updated');
            }
            echo json_encode($json);
        }
    }

    public function update(Request $request)
    {
        
        DB::beginTransaction();
        $success_trans = false;
        // @insert data tbl:Aktivasi_ujian
        try {
            
            $update =[];
            $update['ujian_Aktivasi_id']       = $request->ujian_Aktivasi_id;
            $update['name']       = $request->name;
            $update['aktif']      = $request->aktif;
            $update['keterangan'] = $request->keterangan;
            $update['user_created'] = \Auth::id();
           
            Aktivasi::whereUjianAktivasiId($request->get('ujian_Aktivasi_id'))->update($update);
           
            DB::commit();
            $success_trans = true;
        } catch (\Exception $e) {
            DB::rollback();
            // error page
            abort(403, $e->getMessage());
        }
        if ($success_trans == true) {
            return json_encode(array(
                "status"=>200
            ));
        }
    }

    

}
