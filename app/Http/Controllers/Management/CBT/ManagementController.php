<?php

namespace App\Http\Controllers\Management\CBT;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\MgtProgram;
use App\Models\Program;
use App\Models\Modul;
use App\Models\SubModul;
use DataTables;
use Entrust;
use DB;



class ManagementController extends Controller
{
    //

    public function index()
    {
        $pageTitle = 'LSPPMI - MgtProgram Program';
        $pageHeader = 'MgtProgram';
        $Title = 'ini adalah menu MgtProgram';
        $status       = [
            '0'  => 'Non Aktif',
            '1' => 'Aktif'
        ];
        
        // $modul = Modul::with('submodul')->where('status',1)->get();
        // $Program = [];
        // $program = Program::where('status',1)->get();
        // foreach ($program as $key => $value) {
        //     $Program[$value->id]=$value->name;
        // }

        // $Modul = [];
        // $modul = Modul::where('status',1)->get();
        // foreach ($modul as $key => $value) {
        //     $Modul[$value->id]=$value->name;
        // }
        $dtl_id      = MgtProgram::distinct()->get(['program_id']);
        $Program     = Program::whereNotIn('id', $dtl_id ? $dtl_id : null)->pluck('name', 'id')->prepend('',''); //Dropdown program
        $modul       = Modul::orderBy('name', 'ASC')->where('status', 1)->get(); // dropdown all modul
        $submodul    = SubModul::orderBy('name', 'ASC')->where('status', 1)->pluck('name', 'id'); // dropdown all submodul
        

        $crumbs = explode("/",$_SERVER["REQUEST_URI"]);
        
		return view('management.cbt.mgtprogram', compact('pageTitle','Title','pageHeader','crumbs','status','modul','Program','submodul'));
    }

    public function AjaxMgtProgramGetData()
    {
        $program_dtl    = MgtProgram::where('status', 1)->get(['name','program_id','id']);

        //     return DataTables::of($mgtProgram)->addColumn('action', function (MgtProgram $MgtProgram) {
        //     $action = "<div class='btn-group'>";
        //     $action .= '<button id="edit"   data-code="'.$MgtProgram->code.'" data-id="'.$MgtProgram->id.'" data-nama="'.$MgtProgram->name.'"  class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit ' . $MgtProgram->name . '"><i class="flaticon2 flaticon2-pen"></i></button>';
        //     // $action .= '<button id="view"  data-id="'.$MgtProgram->id.'" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="View ' . $MgtProgram->name . '"><i class="flaticon2 flaticon2-search"></i></button>';
           
		// 	$action .= "</div>";
		// 	return $action;
		// })->addColumn('status', function (MgtProgram $MgtProgram) {
            
        //     if($MgtProgram->status==1){
        //         return "Aktif";
        //     }else{
        //         return "Non Aktif";
        //     }

        // })->make(true); 
        

            return Datatables::of($program_dtl)->addIndexColumn()->addColumn('nama_program', function ($program_dtl) {
                                // get id modul by program id after distinct nama in program_dtl
                                $id_modul = MgtProgram::where('program_id', '=', $program_dtl->program_id)->where('status', 1)->pluck('modul_id');
                                // get row in table modul where modul_id = $id_modul
                                $moduls   = Modul::whereIn('id', $id_modul)->where('status', 1)->get();
                                   
                                // create tree JStree
                                $tree =
                                "
                                <div class='tree' id='tree'>
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
                                    $id_submodul = MgtProgram::where('program_id', '=', $program_dtl->program_id)->where('modul_id', '=', $modul->modul_id)->where('status', 1)->pluck('submodul_id');
                                    // get active row in table submodul where submodul_id = $id_submodul
                                    $submoduls = SubModul::whereIn('submodul_id', $id_submodul)->where('status', 1)->get();
                                    foreach ($submoduls as $submodul) {
                                        // get nama submodul where submodul_id = $submodul->submodul_id
                                        $namasubmodul = SubModul::where('submodul_id', $submodul->submodul_id)->where('status', 1)->value('name');
                                        if (!empty($namasubmodul)) {
                                            $tree.="<li>".$namasubmodul;
                                            $tree.="<ul>";
                                            $id_program_dtl = MgtProgram::where('program_id', '=', $program_dtl->program_id)->where('modul_id', '=', $modul->modul_id)->where('submodul_id', $submodul->submodul_id)->where('status', 1)->value("program_dtl_id","");
                                            // $persentase = MgtProgram::where('program_id', '=', $program_dtl->program_id)->where('modul_id', '=', $modul->modul_id)->where('submodul_id', $submodul->submodul_id)->where('hapus', false)->value("persentase_kelulusan","");
                                            $SoalJenis = SoalJenis::all();
                                            if(Komposisi_soal::where('program_dtl_id',$id_program_dtl)->exists())
                                            {
                                                foreach ($SoalJenis as $jns) {
                                                    $jumlah_soal = Komposisi_soal::where('program_dtl_id',$id_program_dtl)->where('SoalJenis_id',$jns->SoalJenis_id)->value('jumlah_soal'); //value('jumlah_soal')
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
                            })->rawColumns(['nama_program'])->make(true);
        
    // $mgtProgram = MgtProgram::with('program','modul','submodul')->get();
    

    //    return DataTables::of($mgtProgram)->addColumn('action', function (MgtProgram $MgtProgram) {
    //         $action = "<div class='btn-group'>";
    //         $action .= '<button id="edit"   data-code="'.$MgtProgram->code.'" data-id="'.$MgtProgram->id.'" data-nama="'.$MgtProgram->name.'"  class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit ' . $MgtProgram->name . '"><i class="flaticon2 flaticon2-pen"></i></button>';
    //         // $action .= '<button id="view"  data-id="'.$MgtProgram->id.'" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="View ' . $MgtProgram->name . '"><i class="flaticon2 flaticon2-search"></i></button>';
           
	// 		$action .= "</div>";
	// 		return $action;
	// 	})->addColumn('modeltree', function (MgtProgram $MgtProgram) {
            
    //         if($MgtProgram->status==1){
    //             return "Aktif";
    //         }else{
    //             return "Non Aktif";
    //         }

	// 	})->make(true);
    }

    public function AjaxMgtProgramDeleteData(Request $request)
    {
       
        $deleted = MgtProgram::find($request->get('id'))->delete();
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

    public function AjaxGetSubModul(Request $request)
    {
       
        return SubModul::where('id_modul',$request->get('modul_id'))->get();
       
    }

    public function AjaxMgtProgramInsertData(Request $request)
    {
       
        $MgtProgram = new MgtProgram();
        $modul = substr($request->get('modul_id'),6);
        $submodul = substr($request->get('submodul_id'),9);
       
        $program_id   = $request->program; //id program
        $checktree    = $request->checktree;
        $arrtree      = explode(",", $checktree);
        $arrtree      = array_filter($arrtree);
        $nama_program = Program::where('id', $program_id)->first(); //Nama Program

       

        try {
            // insert to tb:Bank
            foreach ($arrtree as $submodul_id) {
                $modul_id =  DB::table('submodul')->where('id', $submodul_id)->value('id_modul');
                $program_dtl               = new MgtProgram;
                $program_dtl->name         = $nama_program->name;
                $program_dtl->modul_id     = $modul_id;
                $program_dtl->submodul_id  = $submodul_id;
                $program_dtl->program_id   = $program_id;
                $program_dtl->status        = 1;
                $program_dtl->created_at = date('Y-m-d H:i:s');
                $program_dtl->user_created = \Auth::id();
                $program_dtl->save();
                if ($program_dtl->save()) {
                            return json_encode(array(
                                "status"=>200
                            ));
                } else {
                            return json_encode(array(
                                "status"=>500
                            ));
                }
            }
            DB::commit();
            $success_trans = true;
        } catch (\Exception $e) {
            DB::rollback();
            // error page
            // abort(403, $e->getMessage());
            return json_encode(array(
                "status"=>403,
                "pesan"=>$e->getMessage()
            ));
        }


    }

}
