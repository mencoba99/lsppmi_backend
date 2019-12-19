<?php

namespace App\Http\Controllers\ManajemenAssessmen\CBT;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\MgtProgram;
use App\Models\Program;
use App\Models\CompetenceUnit;
use App\Models\CompetenceKUK;
use App\Models\SoalJenis;
use App\Models\Komposisi_soal;
use DataTables;
use Entrust;
use DB;
use URL;



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
        $modul       = CompetenceUnit::orderBy('name', 'ASC')->where('status', 1)->get(); // dropdown all modul
        $submodul    = CompetenceKUK::orderBy('name', 'ASC')->pluck('name', 'id'); // dropdown all submodul
        
        $role = null;
        
        return view('ManajemenAssessmen.cbt.ManagementController.create', compact('Program', 'modul', 'submodul','role'));
    }

    public function AjaxMgtProgramGetData()
    {
        
        $program_dtl    = MgtProgram::where('status', 1)->distinct()->get(['name','program_id']);
        

        return Datatables::of($program_dtl)
        ->addIndexColumn()
        /* Create JSTree */
        ->addColumn('nama_program', function ($program_dtl) {
            // get id modul by program id after distinct nama in program_dtl
            $id_modul = MgtProgram::where('program_id', '=', $program_dtl->program_id)->where('status', 1)->pluck('modul_id');
            
            // get row in table modul where modul_id = $id_modul
            $moduls   = CompetenceUnit::whereIn('id', $id_modul)->where('status', 1)->get();
            
            // create tree JStree
            $tree =
            "
                    <div class='tree'>
                      <ul>
                        <li>".$program_dtl->program->name." 
                          <ul>
                          ";
            foreach ($moduls as $modul) {
                if (!empty($modul)) {
                    $tree.="<li>".$modul->name.
                            "<ul>";
                }
                
                // get submodul_id in program_dtl by program_id and modul_id
                $id_submodul = MgtProgram::where('program_id', '=', $program_dtl->program_id)->where('modul_id', '=', $modul->id)->where('status', 1)->pluck('submodul_id');
                // get active row in table submodul where submodul_id = $id_submodul
                // $element = CompetenceElement::whereIn('id', $id_submodul)->where('status', 1)->get();
                $submoduls = CompetenceKUK::whereIn('id', $id_submodul)->where('status', 1)->get();
               
                foreach ($submoduls as $submodul) {
                    // get nama submodul where submodul_id = $submodul->submodul_id
                    $namasubmodul = CompetenceKUK::where('id', $submodul->id)->where('status', 1)->value('name');
                   
                    if (!empty($namasubmodul)) {
                        $tree.="<li> ".$namasubmodul;
                        $tree.="<ul>";
                        $id_program_dtl = MgtProgram::where('program_id', '=', $program_dtl->program_id)->where('modul_id', '=', $modul->id)->where('submodul_id', $submodul->id)->where('status', 1)->value("id","");
                        // $persentase = Program_management::where('program_id', '=', $program_dtl->program_id)->where('modul_id', '=', $modul->modul_id)->where('submodul_id', $submodul->submodul_id)->where('hapus', false)->value("persentase_kelulusan","");
                        $jenis_soal = SoalJenis::all();
                        
                        if(Komposisi_soal::where('program_mgt_id',$id_program_dtl)->exists())
                        {
                            foreach ($jenis_soal as $jns) {
                                $jumlah_soal = Komposisi_soal::where('program_mgt_id',$id_program_dtl)->where('jenis_soal_id',$jns->id)->value('jumlah_soal'); //value('jumlah_soal')
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
        
                            })->addColumn('action', function ( $MgtProgram) {
                                $btn_action = '';
                                
                                    // $btn_action .= '<a data-toggle="tooltip" title="Edit Program '.$MgtProgram->name.'" href=""  class="la la-edit modalIframe"></a>&nbsp;';
                                     
                                
                                    $btn_action .= '<a data-toggle="tooltip" url="" title="Edit Komposisi Soal '.$MgtProgram->name.'"  class="modalIframe la la-cog" id="clearIframe" data-toggle="kt-tooltip"
                                    href="'.route('management.sebaran_soal', ['program_id' => $MgtProgram->program_id]) .'"></a>';
                                
                                    
                                    return $btn_action;
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
       
        return CompetenceKUK::where('id_modul',$request->get('modul_id'))->get();
       
    }

    public function edit_komposisi_soal($program_id)
    {
        $program_dtl    = MgtProgram::where('program_id', $program_id)->where('status', 1)->orderBy('modul_id')->get();
        $total_soal     = SoalJenis::orderBy('name')->get();
        // dd($program_dtl->toArray());
      
       
        return view('ManajemenAssessmen.cbt.ManagementController.sebaran_soal', compact('program_dtl', 'total_soal'));
    }


    public function ajax_update_komposisi_soal(Request $request)
    {
        if ($request->ajax()) {
            $datas          = $request->data;
            DB::beginTransaction();
            $success_trans = false;
            try {
                foreach ($datas as $data) {
                    $program_dtl             = MgtProgram::find($data['program_dtl_id']);
                    $program_dtl->total_soal = !empty($data['total_soal']) ? $data['total_soal'] : null;
                    $program_dtl->save();
                   
                    foreach ($data['jenis_soal'] as $jenis) {
                        $komposisi = Komposisi_soal::updateOrCreate(
                             ['program_mgt_id' => $data['program_dtl_id'],
                             'jenis_soal_id'   => $jenis['jenis_soal_id']], 
                             ['jumlah_soal'    => !empty($jenis['jumlah_soal']) ? $jenis['jumlah_soal'] : null]
                        );
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
                print json_encode($komposisi);
                print json_encode($data);
            }
        }
    }

    public function AjaxMgtProgramInsertData(Request $request)
    {

        $program_id   = $request->program; //id program
        $checktree    = trim($request->checktree, ',');
        $arrtree      = explode(",", $checktree);
        
        $arrtree      = array_filter($arrtree, function($value) { return !is_null($value) && $value !== ''; });
        $nama_program = Program::where('id', $program_id)->first(); //Nama Program
        $submodul = CompetenceKUK::with('element')->whereIn('id',$arrtree)->get();
      
        try {
            foreach ($submodul as $value) {
                
                $program_dtl               = new MgtProgram;
                $program_dtl->name         = $nama_program->name;
                $program_dtl->modul_id     = $value->element->unit->id;
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
