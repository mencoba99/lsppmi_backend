<?php

namespace App\Http\Controllers\ManajemenAssessmen\CBT\Ujian;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\Ujian\Jenis;
use App\Models\Ujian\Ujian_batch;
use App\Models\Ujian\Ujian_modul;
use App\Models\Ujian\Perdana;
use DataTables;
use Entrust;
use DB;
use Carbon\Carbon;



class JenisController extends Controller
{
    

    public function index()
    {
		return view('ManajemenAssessmen.cbt.ujian.JenisController.index');
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
        
        return view('ManajemenAssessmen.cbt.ujian.JenisController.create',
        compact('hari', 'jams', 'ruang')
        );
    }

    public function edit($jenis_ujian_id)
    {
        $jenis_ujian  = Jenis::find($jenis_ujian_id);
        return view('ManajemenAssessmen.cbt.ujian.JenisController.edit',
                    compact('jenis_ujian')
                );
    }


    public function data(Request $request)
    {
        return DataTables::of(Jenis::all())->addColumn('action', function (Jenis $Jenis) {
           
            $action = '';
            if (auth()->user()->can('Tempat Uji Kompetensi (TUK) Edit')) {
                $action .= "<a href='" . route('ujian.jenis.edit', ['ujian_jenis_id' => $Jenis]) . "' class='btn btn-sm btn-icon btn-clean btn-icon-sm modalIframe' data-toggle='kt-tooltip' title='Edit ".$Jenis->name."' data-original-tooltip='View ".$Jenis->name."'><i class='la la-pencil'></i></a>";
           
            }
            if (auth()->user()->can('Tempat Uji Kompetensi (TUK) Delete')) {
                $action .= "<a href='" . route('ujian.jenis.delete', ['ujian_jenis_id' => $Jenis]) . "' class='btn btn-sm btn-icon btn-clean btn-icon-sm delconfirm' data-toggle='kt-tooltip' title='Hapus' data-original-tooltip='Hapus'>
                                <i class='la la-trash'></i>
                </a>";
            }
			return $action;
			
		})->addColumn('aktif', function (Jenis $Jenis) {

            if($Jenis->aktif==true){
                return "Aktif";
            }else{
                return "Non Aktif";
            }

		})->make(true);
   
    }
    

    public function delete(Request $request)
    {
       
        $deleted = Jenis::find($request->ujian_jenis_id)->delete();
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

    

    public function insert(Request $request)
    {
        
        DB::beginTransaction();
        $success_trans = false;
        // @insert data tbl:Jenis
        try {
            $Jenis               = new Jenis();
            $Jenis->name         = $request->name;
            $Jenis->keterangan   = $request->keterangan;
            $Jenis->user_created = \Auth::user()->id;
            $Jenis->aktif        = $request->aktif;
            $Jenis->save();
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

    public function update(Request $request)
    {
        
        DB::beginTransaction();
        $success_trans = false;
        // @insert data tbl:jenis_ujian
        try {
            
            $update =[];
            $update['ujian_jenis_id']       = $request->ujian_jenis_id;
            $update['name']       = $request->name;
            $update['aktif']      = $request->aktif;
            $update['keterangan'] = $request->keterangan;
            $update['user_created'] = \Auth::id();
           
            Jenis::whereUjianJenisId($request->get('ujian_jenis_id'))->update($update);
           
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
