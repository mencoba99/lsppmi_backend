<?php

namespace App\Http\Controllers\ManajemenAssessmen\CBT\Ujian;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\Ujian\Parameter;
use App\Models\Ujian\Ujian_batch;
use App\Models\Ujian\Ujian_modul;
use App\Models\Ujian\Perdana;
use DataTables;
use Entrust;
use DB;
use Carbon\Carbon;



class ParameterController extends Controller
{
    

    public function index()
    {
		return view('ManajemenAssessmen.cbt.ujian.ParameterController.index');
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
        
        return view('ManajemenAssessmen.cbt.ujian.ParameterController.create',
        compact('hari', 'jams', 'ruang')
        );
    }

    public function edit($Parameter_ujian_id)
    {
        $Parameter_ujian  = Parameter::find($Parameter_ujian_id);
        return view('ManajemenAssessmen.cbt.ujian.ParameterController.edit',
                    compact('Parameter_ujian')
                );
    }


    public function data(Request $request)
    {
        return DataTables::of(Parameter::all())->addColumn('action', function (Parameter $Parameter) {
           
            $action = '';
            if (auth()->user()->can('Tempat Uji Kompetensi (TUK) Edit')) {
                $action .= "<a href='" . route('ujian.parameter.edit', ['ujian_parameter_id' => $Parameter]) . "' class='btn btn-sm btn-icon btn-clean btn-icon-sm modalIframe' data-toggle='kt-tooltip' title='Edit ".$Parameter->name."' data-original-tooltip='View ".$Parameter->name."'><i class='la la-pencil'></i></a>";
           
            }
            if (auth()->user()->can('Tempat Uji Kompetensi (TUK) Delete')) {
                $action .= "<a href='" . route('ujian.parameter.delete', ['ujian_parameter_id' => $Parameter]) . "' class='btn btn-sm btn-icon btn-clean btn-icon-sm delconfirm' data-toggle='kt-tooltip' title='Hapus' data-original-tooltip='Hapus'>
                                <i class='la la-trash'></i>
                </a>";
            }
			return $action;
			
		})->addColumn('status', function (Parameter $Parameter) {

            if($Parameter->aktif==true){
                return "Aktif";
            }else{
                return "Non Aktif";
            }

        })
        ->addColumn('durasi_default_ujian', function (Parameter $Parameter) {
            return $Parameter->durasi_default_ujian.' Menit';
        })
        ->addColumn('durasi_masa_aktif_ujian', function (Parameter $Parameter) {
            return $Parameter->durasi_masa_aktif_ujian.' Bulan';
        })->make(true);
   
    }
    

    public function delete(Request $request)
    {
       
        if (auth()->user()->can('Ujian Parameter Delete')) {
            $deleted = Parameter::find($request->ujian_parameter_id)->delete();
            if ($deleted) {
                flash()->success('Berhasil menghapus Data');
            } else {
                flash()->error('Gagal menghapus Data');
            }
        } else {
            flash()->error('Maaf, Anda tidak mempunyai akses untuk menghapus Role');
        }

        return redirect()->route('ujian.parameter');
    }

    

    public function insert(Request $request)
    {
        
        DB::beginTransaction();
        $success_trans = false;
        // @insert data tbl:Parameter
        try {
            $Parameter               = new Parameter();
            $Parameter->name         = $request->name;
            $Parameter->durasi_masa_aktif_ujian   = $request->durasi_masa_aktif_ujian;
            $Parameter->durasi_default_ujian   = $request->durasi_default_ujian;
            $Parameter->keterangan   = $request->keterangan;
            $Parameter->user_deleted = \Auth::user()->id;
            $Parameter->user_created = \Auth::user()->id;
            $Parameter->aktif        = $request->aktif;
            $Parameter->hapus        = FALSE;
            $Parameter->save();
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
        // @insert data tbl:Parameter_ujian
        try {
            
            $update =[];
            $update['ujian_Parameter_id']       = $request->ujian_Parameter_id;
            $update['name']       = $request->name;
            $update['aktif']      = $request->aktif;
            $update['keterangan'] = $request->keterangan;
            $update['user_created'] = \Auth::id();
           
            Parameter::whereUjianParameterId($request->get('ujian_Parameter_id'))->update($update);
           
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
