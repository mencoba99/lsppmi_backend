<?php

namespace App\Http\Controllers\ManajemenAssessmen\CBT\Materi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\Modul;
use App\Models\SubModul;
use DataTables;
use Entrust;

class PembuatanSubModulController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:Submodul']);
    }
    
    public function index()
    {
        $Modul     = Modul::orderBy('name', 'ASC')->pluck('name', 'id')->prepend('',''); //Dropdown Unit
		return view('ManajemenAssessmen.cbt.materi.submodul', compact('Modul'));
    }

    public function AjaxSubModulGetData()
    {
        $Data = SubModul::with(['modul'])->get();
       
       return DataTables::of($Data)->addColumn('action', function (SubModul $SubModul) {
            $action = "<div class='btn-group'>";
            if (auth()->user()->can('Submodul Edit')) {
                $action .= '<button id="edit" data-aktif="'.$SubModul->aktif.'" data-modul="'.$SubModul->modul->id.'"  data-id="'.$SubModul->id.'" data-nama="'.$SubModul->name.'" data-desc="'.$SubModul->description.'" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit ' . $SubModul->name . '"><i class="flaticon2 flaticon2-pen"></i></button>';
            }  
            if (auth()->user()->can('Submodul Delete')) {
                //  $action .= '<button id="hapus"  data-id="'.$SubModul->id.'" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete ' . $SubModul->name . '"><i class="flaticon2 flaticon2-trash"></i></button>';
            }      
			$action .= "</div>";
			return $action;
		})->addColumn('status_s', function (SubModul $SubModul) {
            
            if($SubModul->aktif==1){
                return "Aktif";
            }else{
                return "Non Aktif";
            }

		})->make(true);
    }

    public function AjaxSubModulDeleteData(Request $request)
    {
        if (auth()->user()->can('Submodul Delete')) {
        $deleted = SubModul::find($request->get('id'))->delete();
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
    }

    public function AjaxSubModulInsertData(Request $request)
    {

        $SubModul = new SubModul();
        $SubModul->name = $request->get('name');
        $SubModul->description = $request->get('desc');
        $SubModul->id_modul = $request->get('id_modul');
        $SubModul->aktif = $request->get('status');
        $SubModul->status = 1;


        if($request->get('id')){

            $update =[];
            $update['id'] = $request->get('id');
            $update['name'] = $request->get('name');
            $update['id_modul'] = $request->get('id_modul');
            $update['description'] = $request->get('desc');
            $update['aktif'] = $request->get('status');
            if(SubModul::whereId($request->get('id'))->update($update)){
                return json_encode(array(
                    "status"=>200,
                    "message"=>"sukses"
                ));
            }else{
                return json_encode(array(
                    "status"=>500,
                    "message"=>"error"
                ));
            }

        }else{

            if ($SubModul->save()) {
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
}
