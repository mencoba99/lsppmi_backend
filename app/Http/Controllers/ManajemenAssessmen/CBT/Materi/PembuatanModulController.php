<?php

namespace App\Http\Controllers\ManajemenAssessmen\CBT\Materi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\Modul;
use DataTables;
use Entrust;


class PembuatanModulController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:Modul']);
    }
    
    public function index()
    {
       return view('ManajemenAssessmen.cbt.materi.modul');
    }

    public function AjaxModulGetData()
    {
       return DataTables::of(Modul::all())->addColumn('action', function (Modul $Modul) {
            $action = "<div class='btn-group'>";
            if (auth()->user()->can('Modul Edit')) {
                $action .= '<button id="edit" data-status="'.$Modul->status.'" data-persen="'.$Modul->persentase.'" data-eng="'.$Modul->sing_eng.'"  data-harga="'.$Modul->price.'" data-id="'.$Modul->id.'" data-nama="'.$Modul->name.'" data-desc="'.$Modul->description.'" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit ' . $Modul->name . '"><i class="flaticon2 flaticon2-pen"></i></button>';
                // $action .= '<button id="hapus"  data-id="'.$Modul->id.'" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete ' . $Modul->name . '"><i class="flaticon2 flaticon2-trash"></i></button>';
            }
			$action .= "</div>";
			return $action;
		})->addColumn('status', function (Modul $Modul) {

            if($Modul->aktif==true){
                return "Aktif";
            }else{
                return "Non Aktif";
            }

		})->make(true);
    }

    public function AjaxModulDeleteData(Request $request)
    {

        $deleted = Modul::find($request->get('id'))->delete();
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

    public function AjaxModulInsertData(Request $request)
    {

        $Modul = new Modul();
        $Modul->name = $request->get('name');
        $Modul->description = $request->get('desc');
        $Modul->persentase = $request->get('persen');
        $Modul->sing_eng = $request->get('sing_eng');
        $Modul->aktif = $request->get('status') ? TRUE : FALSE;

        if($request->get('id')){ // for update

            $update =[];
            $update['id'] = $request->get('id');
            $update['name'] = $request->get('name');
            $update['description'] = $request->get('desc');
            $update['persentase'] = $request->get('persen');
            $update['sing_eng'] = $request->get('sing_eng');
            $update['aktif'] = $request->get('status') ? TRUE : FALSE;
            if(Modul::whereId($request->get('id'))->update($update)){
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

            if ($Modul->save()) {
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
