<?php

namespace App\Http\Controllers\ManajemenAssessmen\CBT\Ujian;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\Ujian\Jadwal;
use App\Models\Ujian\Ujian_batch;
use App\Models\Ujian\Ujian_modul;
use App\Models\Ujian\Perdana;
use App\Models\ProgramSchedule;
use App\Models\Modul;
use App\Models\SubModul;
use App\Models\Members;
use App\Models\StartUjian\Perdana_peserta;
use App\Models\MasterData\Hari;
use DataTables;
use Entrust;
use DB;
use Carbon\Carbon;



class JadwalController extends Controller
{
    

    public function index()
    {
		return view('ManajemenAssessmen.cbt.ujian.JadwalController.index');
    }

    public function create()
    {
        $ruang       = DB::table('competence_places')->select(DB::raw("CONCAT(competence_places.name,' - Kapasitas ', ' Orang') AS nama"),'competence_places.id')                             ->where('competence_places.status', '=', 1)
                                         ->where('status', '=', 1)
                                         ->orderBy('name', 'ASC')
                                         ->pluck('nama', 'competence_places.id');
        
        $hari        = DB::table('hari')->select('hari.hari_id', 'hari.name')->get();
        // get jam
        $jams        = DB::table('jam')->select('jam.jam_id', 'jam.name')->orderBy('name', 'ASC')->get();
        
        return view('ManajemenAssessmen.cbt.ujian.JadwalController.create',
        compact('route_store', 'route_index', 'hari', 'jams', 'ruang')
        );
    }

    public function ajax_get_batch(Request $request){
       
            $jadwal_id = $request->jadwal_id;
            // get status user logged in
            // $cabang_ho  = DB::table('cabang')->where('ho', TRUE)->where('aktif', TRUE)->where('hapus', FALSE)->pluck('cabang_id');
            // $emp_ho     = DB::table('employee')->whereIn('cabang_id', $cabang_ho)->pluck('emp_id');
            $admin      = \Auth::user()->id == 1 ? true : false;
            // $user_ho    = $emp_ho->contains(\Auth::user()->emp_id);
            // ---------------------------------------------
            // get 'all batch and not in ujian_batch' 
        
            $batch_in_ujian = Ujian_batch::where('perdana_jadwal_id', $jadwal_id)->pluck('ujian_batch_id');
            $batch = ProgramSchedule::select('program_schedules.id AS _id', 'programs.name')
            ->where('program_schedules.aktif', true)
            ->where('program_schedules.is_approve', true)
            ->where('program_schedules.is_ujian', true)
            ->where('program_schedules.status', '=', '5')/* Ujian Open */
            ->join('programs', 'program_schedules.program_id', '=', 'programs.id')
            ->whereNotIn('program_schedules.id', $batch_in_ujian)
            ->orderBy('programs.name')
            ->get()
            ->toArray();

            // if($admin == true){
            //     $batch = ProgramSchedule::select('program_schedules.id AS _id', 'programs.name')
            //                 ->where('program_schedules.aktif', true)
            //                 ->where('program_schedules.is_approve', true)
            //                 ->where('program_schedules.is_ujian', true)
            //                 ->where('program_schedules.status', '=', '5')/* Ujian Open */
            //                 ->join('programs', 'program_schedules.program_id', '=', 'programs.id')
            //                 ->whereNotIn('program_schedules.id', $batch_in_ujian)
            //                 ->orderBy('programs.name')
            //                 ->get()
            //                 ->toArray();
                           
            // } elseif(\Auth::user()->emp_id != null){
            //     // $emp_kp = DB::table('users')->where('competence_place_id', \Auth::user()->emp_id)->value('lembg_pdkn_id');
            //     $batch = ProgramSchedule::select('program_schedules.id AS _id', 'programs.name')
            //                 ->where('program_schedules.aktif', true)
            //                 ->where('program_schedules.is_approve', true)
            //                 ->where('program_schedules.is_ujian', true)
            //                 ->where('program_schedules.status', '=', '5')/* Ujian Open */
            //                 ->join('programs', 'program_schedules.program_id', '=', 'programs.id')
            //                 ->whereNotIn('program_schedules.id', $batch_in_ujian)
            //                 ->orderBy('programs.name')
            //                 ->get()
            //                 ->toArray();
            // } else {
            //     $batch = [];
            // }
            
            if(!empty($batch)){
                echo json_encode($batch);
            }else{
                echo json_encode(array());
            }
    
    }


    public function ajax_get_batch_peserta(Request $request){
        
            $jadwal_id = $request->jadwal_id;
            // ---------------------------------------------
            // get 'all batch and not in ujian_batch' 
            $batch_peserta = array();
            $batch_in_ujian = Ujian_batch::select(['ujian_batch.program_schedule_id', 'ujian_batch.ujian_batch_id'])->where('perdana_jadwal_id', $jadwal_id)->get();
           
            foreach ($batch_in_ujian as $data) {
                
                $data_batch = ProgramSchedule::where('id', $data->program_schedule_id)->first();
                $arr['program_schedule_id'] = $data_batch->id;
                $arr['nama_batch'] = $data_batch->programs->name;
                $arr['ujian_batch_id'] = $data->program_id;
                $arr['modsub'] = array();
                $arr['peserta'] = array();
                // return $data_batch; exit;
                $peserta_ids = Perdana_peserta::where('ujian_batch_id', $data->ujian_batch_id)->pluck('peserta_id');
                /* GET MODUL SUBMODUL BY BATCH ID */
                $data_modul = Ujian_modul::select(['ujian_modul.modul_id'])->where('ujian_batch_id', $data->ujian_batch_id)->distinct()->get();
                foreach ($data_modul as $value_mod) {
                    $nama_m            = Modul::where('id', $value_mod->modul_id)->value('name');
                    $arrmodsub['modul_id']   = $value_mod->modul_id;
                    $arrmodsub['nama_modul'] = $nama_m;
                    $arrmodsub['submodul']   = [];
                    $data_submodul           = Ujian_modul::where('ujian_batch_id', $data->ujian_batch_id)->where('modul_id', $value_mod->modul_id)->get(['submodul_id']);
                    foreach ($data_submodul as $key => $value_sub) {
                        $nama_s   = SubModul::where('id', $value_sub->submodul_id)->value('name');
                        $nest_arr = array('submodul_id'     => $value_sub->submodul_id,
                                          'nama_submodul'   => $nama_s
                      );
                        array_push($arrmodsub['submodul'], $nest_arr);
                    }
                    array_push($arr['modsub'], $arrmodsub);
                }
                //* END *//
                $data_peserta = Members::select(['members.id', 'members.name', 'members.email'])->whereIn('id', $peserta_ids)->get();
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

    public function AjaxJadwalGetData(Request $request)
    {
        $sql_no_urut    = \Yajra_datatable::get_no_urut('perdana_jadwal.tgl_perdana'/*primary_key*/, $request);
        $jadwal         = DB::table('perdana_jadwal')
        ->select([
                DB::raw($sql_no_urut), // nomor urut
                'perdana_jadwal.perdana_jadwal_id AS _id',
                'perdana_jadwal.name AS nama',
                'perdana_jadwal.tgl_perdana AS tgl_perdana',
                'competence_places.name AS nama_ruang',
                'perdana_jadwal.hari_id AS nama_hari',
                'jam.name AS nama_jam'
                ])
        ->join('perdana', 'perdana.perdana_id', '=', 'perdana_jadwal.perdana_id')
        ->join('hari', 'perdana_jadwal.hari_id', '=', 'hari.hari_id')
        ->join('jam', 'perdana_jadwal.jam_id', '=', 'jam.jam_id')
        ->join('competence_places', 'competence_places.id', '=', 'perdana.competence_places_id')
        ->where('perdana.deleted_at', null)
        ->whereDate('perdana_jadwal.tgl_perdana', '>=', date('Y-m-d'))
        ->where('perdana_jadwal.is_aktif', TRUE);

        return Datatables::of($jadwal)
        ->addIndexColumn()
        ->addColumn('tgl_perdanas', function($jadwal){
            // return \Helper::date_formats($jadwal->tgl_perdana, 'view');
        })
        ->addColumn('rownum', function($jadwal){
            return '<i data-jadwal="'.$jadwal->_id.'" class="fa fa-plus-circle row-details" style="cursor: pointer;font-size: 15px;"></i>';
        })
        ->addColumn('action', function ( $jadwal)  {
            $action = "<div class='btn-group'>";
            $action .= '<button data-jadwal="'.$jadwal->_id.'" class="edit_modal_batch btn btn-sm btn-icon btn-clean btn-icon-sm" title="Edit"><i class="fa fa-tasks"></i></button>';
            $action .= '<button data-jadwal="'.$jadwal->_id.'" class="edit_modal_peserta btn btn-sm btn-icon btn-clean btn-icon-sm" title="Edit"><i class="fa fa-users"></i></button>';
            $action .= '<button data-jadwal="'.$jadwal->_id.'" class="btn btn-sm btn-icon btn-clean btn-icon-sm" title="Edit"><i class="fa fa-user-secret"></i></button>';
            $action .= '<button data-jadwal="'.$jadwal->_id.'" class="btn btn-sm btn-icon btn-clean btn-icon-sm" title="Edit"><i class="fa fa-file-pdf"></i></button>';
           
			$action .= "</div>";
            return $action;
            

            // $btn_action = '';
            // $btn_action .= '&nbsp;<a data-jadwal="'.$jadwal->_id.'" title="Edit Submodul diujikan" class="fa fa-tasks edit_modal_batch"></a>&nbsp;';
            // $ujian_batch     = Ujian_batch::where('perdana_jadwal_id', $jadwal->_id)->pluck('ujian_batch_id');
            // $ujian_modul     = Ujian_modul::whereIn('ujian_batch_id', $ujian_batch)->get()->count();
            // if($ujian_modul) {
            //    $btn_action .= '&nbsp;<a kapasitas="" data-jadwal="'.$jadwal->_id.'" title="Edit Peserta" class="fa fa-users edit_modal_peserta"></a>&nbsp;';
            // }
            //     $btn_action .= '&nbsp;<a data-jadwal="'.$jadwal->_id.'" title="Set Pengawas &amp; Keyboard Lock" class="fa fa-user-secret edit_modal_pengawas"></a>&nbsp;';
            // if($ujian_modul) {
            //     // $btn_action .= '&nbsp;<a target="_blank" href="'. URL::to($this->folder.'/'.$this->controller.'/ajax_print_perdana').'/'.$jadwal->_id .'" title="Print Peserta Ujian" class="fa fa-file-pdf-o"></a>&nbsp;';
            // }
            // return $btn_action;
        })
        ->rawColumns(['rownum', 'action']) // to html
        ->make(true);
   
    }

    public function AjaxJadwalDeleteData(Request $request)
    {

        $deleted = Jadwal::find($request->get('id'))->delete();
        if ($deleted) {
            return json_encode(array(
                    "status"=>200
                ));
        } else {
            return json_encode(array(
                    "status"=>500
                ));
        }
    }

    private function generateDateRange(Carbon $start_date, Carbon $end_date)
    {
        $dates = [];
        for($date = $start_date; $date->lte($end_date); $date->addDay()) {
            $dates[] = $date->format('D,Y-m-d '); //original Y-m-d
        }
        return $dates;
    }


    public function ajax_get_peserta(Request $request){
      
            $sesi_id        = $request->sesi_id;
            $ujian_batch    = Ujian_batch::where('perdana_jadwal_id', $sesi_id)->get(['program_schedule_id','ujian_batch_id']);
            $batch_id       = Ujian_batch::where('perdana_jadwal_id', $sesi_id)->pluck('program_schedule_id');
            $ujian_batch_id = Ujian_batch::whereIn('program_schedule_id', $batch_id)->pluck('ujian_batch_id');
            $peserta        = array();
            foreach ($ujian_batch as $value) {
                $nama_batch             = ProgramSchedule::find($value->program_schedule_id);
                $arrb['id_batch']       = $value->id;
                $arrb['nama_batch']     = $nama_batch->programs->name;
                $arrb['ujian_batch_id'] = $value->ujian_batch_id;
                return $value; exit;
                $peserta_perdana        = Ujian_batch::select('perdana_peserta.peserta_id')
                                                     ->where('ujian_batch.batch_id', $value->batch_id)
                                                     ->join('perdana_peserta', 'perdana_peserta.ujian_batch_id', '=',
                                                            'ujian_batch.ujian_batch_id')
                                                     ->get();
                $peserta_pendaftar      = Pendaftaran_trx::where('pendaftaran_trx.batch_id', $value->batch_id)
                                                         ->whereNotIn('peserta_id', $peserta_perdana)
                                                         // ->join('perdana_peserta', 'perdana_peserta.ujian_batch_id', '=', 
                                                         //    'ujian_batch.ujian_batch_id')
                                                         // ->whereNotIn('peserta_id', function($query) use($value) {
                                                         //      $query->select(DB::raw('peserta_id'))
                                                         //            ->from('perdana_peserta')
                                                         //            ->where('ujian_batch_id', $value->ujian_batch_id);
                                                         //          })
                                                         ->whereNotIn('peserta_aktivasi_id', function($q){
                                                                $q->select('peserta_aktivasi_id')
                                                                  ->from('peserta_cancel');
                                                           })
                                                         ->pluck('peserta_id');
                $peserta_ujian         = Perdana_peserta::whereIn('ujian_batch_id', $ujian_batch_id)
                                                         ->pluck('peserta_id');
                $list_peserta           = Peserta::select(['peserta.peserta_id AS _id', 'peserta.nama AS nama'])->orderBy('nama')->whereIn('peserta_id', $peserta_pendaftar)->get();
                $m  = array();
                foreach ($list_peserta as $data) {
                    $n = array();
                    $n['peserta_id'] = $data->_id;
                    $n['nama']       = $data->nama;
                    array_push($m, $n);
                }
                $arrb['peserta'] = $m;
                $perdana_peserta        = Perdana_peserta::where('ujian_batch_id', $value->ujian_batch_id)
                                                         ->whereNotIn('perdana_peserta_id', function($query) {
                                                                    $query->select(DB::raw('perdana_peserta_id'))
                                                                          ->from('soal_peserta');
                                                                      })
                                                         ->pluck('peserta_id');
                $list_peserta_selected  = Peserta::select(['peserta.peserta_id AS _id', 'peserta.nama AS nama'])->whereIn('peserta_id', $perdana_peserta)->get();
                $o  = array();
                foreach ($list_peserta_selected as $dataselected) {
                    $p = array();
                    $p['peserta_id'] = $dataselected->_id;
                    $p['nama']       = $dataselected->nama;
                    array_push($o, $p);
                }
                $arrb['peserta_selected'] = $o;
                array_push($peserta, $arrb);
            }
            if(!empty($peserta)){
                echo json_encode($peserta);
            }else{
                echo json_encode(array());
            }
    }

    public function AjaxJadwalInsertData(Request $request)
    {

        $weekday    = Array(7);
        $weekday['Sun'] =  "Minggu";
        $weekday['Mon'] = "Senin";
        $weekday['Tue'] = "Selasa";
        $weekday['Wed'] = "Rabu";
        $weekday['Thu'] = "Kamis";
        $weekday['Fri'] = "Jumat";
        $weekday['Sat'] = "Sabtu";
        $i = 1;
        
        

        DB::beginTransaction();
        $success_trans = false;
        try {
            $ujian_perdana               = new Perdana;
            $ujian_perdana->name         = $request->name;
            $ujian_perdana->competence_places_id     = $request->tuk_id;
            $ujian_perdana->tgl_awal     = \Helper::date_formats($request->tgl_awal, 'db');
            $ujian_perdana->tgl_akhir    = \Helper::date_formats($request->tgl_akhir, 'db');
            // $ujian_perdana->date_created = date('Y-m-d H:i:s');
            $ujian_perdana->user_created = \Auth::user()->id;
            $ujian_perdana->save();

            

            $theId = $ujian_perdana->perdana_id;
            
            // get all day from daterange
            $tgl_awal  = new Carbon($request->tgl_awal);
            $tgl_akhir = new Carbon($request->tgl_akhir);
            $allDates  = $this->generateDateRange($tgl_awal,$tgl_akhir);
            
            $jam_hari = collect($request->jam_hari);
                foreach($allDates as $date){
                    $getDay = substr($date, 0, strpos($date, ","));
                    $getDate = substr($date, strpos($date, ",") + 1);
                   
                    foreach ($jam_hari as $value) {
                         
                        $exjamhari          = explode('|', $value);
                        $nama_hari = Hari::find($exjamhari[1]);
                        // echo $nama_hari->name; exit;
                        // echo $weekday[$getDay]; exit;
                        if($nama_hari->name == $weekday[$getDay])
                        {

                           
                            $jadwal_ujian_perdana                = new Jadwal;
                            $jadwal_ujian_perdana->perdana_id    = $theId;
                            $jadwal_ujian_perdana->name          = $request->name. ' ke ' . $i;
                            $jadwal_ujian_perdana->tgl_perdana   = $getDate;
                            $jadwal_ujian_perdana->jam_id        = $exjamhari[0];
                            $jadwal_ujian_perdana->hari_id       = $exjamhari[1];
                            $jadwal_ujian_perdana->is_aktif      = TRUE;
                            $jadwal_ujian_perdana->created_at  = date('Y-m-d H:i:s');
                            $jadwal_ujian_perdana->user_created  = \Auth::user()->id;
                            $jadwal_ujian_perdana->save();
                            $i++;
                        }
                        
                    }
                }

                
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
