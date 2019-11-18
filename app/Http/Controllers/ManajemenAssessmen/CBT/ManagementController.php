<?php

namespace App\Http\Controllers\ManajemenAssessmen\CBT;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\MgtProgram;
use App\Models\Program;
use App\Models\Modul;
use App\Models\SubModul;
use App\Models\SoalJenis;
use App\Models\Komposisi_soal;
use DataTables;
use Entrust;
use DB;



class ManagementController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['permission:Tempat Uji Kompetensi (TUK)']);
    }
   

    public function index()
    {
		return view('ManajemenAssessmen.cbt.ManagementController.index');
    }

   

    public function create()
    {
        $dtl_id      = MgtProgram::distinct()->get(['program_id']);
        $Program     = Program::whereNotIn('id', $dtl_id)->pluck('name', 'id')->prepend('',''); //Dropdown program
        $modul       = Modul::orderBy('name', 'ASC')->where('aktif', 'true')->where('status', 1)->get(); // dropdown all modul
        $submodul    = SubModul::orderBy('name', 'ASC')->where('aktif', 'true')->where('status', 1)->pluck('name', 'id'); // dropdown all submodul
        $role = null;
        
        return view('ManajemenAssessmen.cbt.ManagementController.create', compact('Program', 'modul', 'submodul','role'));
    }

    public function AjaxMgtProgramGetData()
    {
        
        $program_dtl    = MgtProgram::get(['name','program_id','id']);

            return Datatables::of($program_dtl)->addIndexColumn()->addColumn('nama_program', function ($program_dtl) {
                $id_modul = MgtProgram::where('program_id', '=', $program_dtl->program_id)->where('status', 1)->pluck('modul_id');
                $moduls   = Modul::whereIn('id', $id_modul)->where('status', 1)->get();

                $tree     = "<div class='tree' id='tree'>
                                <ul>
                                    <li>".$program_dtl->program->name."
                                        <ul>";

                                    foreach ($moduls as $modul) {
                                    if (!empty($modul)) {
                                        $tree.="<li>".$modul->name.
                                                "<ul>";
                                    }
                                    
                                    $id_submodul = MgtProgram::where('program_id', '=', $program_dtl->program_id)->where('modul_id', '=', $modul->id)->where('status', 1)->pluck('submodul_id');
                                 
                                    // get active row in table submodul where submodul_id = $id_submodul
                                    $submoduls = SubModul::whereIn('id', $id_submodul)->where('status', 1)->get();
                                   
                                    foreach ($submoduls as $submodul) {
                                        // get nama submodul where submodul_id = $submodul->submodul_id
                                        // $tree .= $submodul->id;
                                        $namasubmodul = SubModul::where('id', $submodul->id)->where('status', 1)->value('name');
                                        if (!empty($namasubmodul)) {
                                            $tree.="<li id='submodul'>".$namasubmodul;
                                            $tree.="<ul>";
                                            $id_program_dtl = MgtProgram::where('program_id', '=', $program_dtl->program_id)->where('modul_id', '=', $modul->modul_id)->where('submodul_id', $submodul->submodul_id)->where('status', 1)->value("id","");
                                            // $persentase = MgtProgram::where('program_id', '=', $program_dtl->program_id)->where('modul_id', '=', $modul->modul_id)->where('submodul_id', $submodul->submodul_id)->where('hapus', false)->value("persentase_kelulusan","");
                                            $SoalJenis = SoalJenis::all();
                                            if(Komposisi_soal::where('program_mgt_id',$id_program_dtl)->exists())
                                            {
                                                foreach ($SoalJenis as $jns) {
                                                    $jumlah_soal = Komposisi_soal::where('program_mgt_id',$id_program_dtl)->where('SoalJenis_id',$jns->SoalJenis_id)->value('jumlah_soal'); //value('jumlah_soal')
                                                    $tree.="<li >".$jns->name."  : ".$jumlah_soal."</li>";
                                                }
                                                // $sign = $persentase == null ? '' : '%';
                                                // $tree.="<li >Persentase Kelulusan : ".$persentase.$sign."</li>";
                                            }            
                                                $tree.="</ul></li>";
                                        }
                                    } //end foreach $submodul
                                    $tree.="    </ul>
                                                </li>";
                                } //end foreach $modul
                                            $tree.=
                                            "
                                              </ul>
                                            </li>
                                          </ul>
                                        </div>
                                    ";
                                    return $tree;
                            })->addColumn('action', function (MgtProgram $MgtProgram) {
                                
                                    $action = "<a href='" . route('ujian-komputer.management.show', ['mgtprogram' => $MgtProgram]) . "' class='btn btn-sm btn-icon btn-clean btn-icon-sm modalIframe' data-toggle='kt-tooltip' title='View ".$MgtProgram->name."' data-original-tooltip='View ".$MgtProgram->name."'>
                                    <i class='la la-search'></i>
                                    </a>";
                                    if (auth()->user()->can('Tempat Uji Kompetensi (TUK) Edit')) {
                                        $action .= "<a href='" . route('ujian-komputer.management.edit', ['mgtprogram' => $MgtProgram]) . "' class='btn btn-sm btn-icon btn-clean btn-icon-sm' data-toggle='kt-tooltip' title='Edit' data-original-tooltip='Edit'>
                                                        <i class='la la-edit'></i>
                                                    </a>";
                                    }
                                    if (auth()->user()->can('Tempat Uji Kompetensi (TUK) Delete')) {
                                        $action .= "<a href='" . route('ujian-komputer.management.delete', ['mgtprogram' => $MgtProgram]) . "' class='btn btn-sm btn-icon btn-clean btn-icon-sm delconfirm' data-toggle='kt-tooltip' title='Hapus' data-original-tooltip='Hapus'>
                                                        <i class='la la-trash'></i>
                                                    </a>";
                                    }
      
                  return $action;
                            })->rawColumns(['nama_program','action'])->make(true);
        
    
    }

    public function AjaxMgtProgramDeleteData(MgtProgram $mgtprogram)
    {

        if (auth()->user()->can('Tempat Uji Kompetensi (TUK) Delete')) {
            if ($mgtprogram->delete()) {
                flash()->success('Berhasil menghapus data TUK');
            } else {
                flash()->error('Gagal menghapus data TUK');
            }
        } else {
            flash()->error('Maaf, Anda tidak mempunyai akses untuk menghapus data TUK');
        }
        return redirect()->route('ujian-komputer.management');
    }

    public function AjaxGetSubModul(Request $request)
    {
       
        return SubModul::where('id_modul',$request->get('modul_id'))->get();
       
    }

    public function AjaxMgtProgramInsertData(Request $request)
    {

        $program_id   = $request->program; //id program
        $checktree    = trim($request->checktree, ',');
        $arrtree      = explode(",", $checktree);
        
        $arrtree      = array_filter($arrtree, function($value) { return !is_null($value) && $value !== ''; });
        $nama_program = Program::where('id', $program_id)->first(); //Nama Program
        $submodul = SubModul::find($arrtree);
        try {
            foreach ($submodul as $value) {
                $program_dtl               = new MgtProgram;
                $program_dtl->name         = $nama_program->name;
                $program_dtl->modul_id     = $value->id_modul;
                $program_dtl->submodul_id  = $value->id;
                $program_dtl->program_id   = $program_id;
                $program_dtl->status       = $request->status;
                $program_dtl->created_at = date('Y-m-d H:i:s');
                $program_dtl->user_created = \Auth::id();
                $program_dtl->save();
                
                
            }
            // DB::commit();
            $success_trans = true;
        } catch (\Exception $e) {
            return json_encode(array(
                "status"=>403,
                "pesan"=>$e->getMessage()
            ));
        }

        if ($success_trans) {
            return json_encode(array(
                "status"=>200
                ));
            } else {
            return json_encode(array(
                "status"=>500
                ));
        }


    }

}
