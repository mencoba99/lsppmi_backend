<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Provinsi;
use App\Models\Kota;
use DataTables;
use Entrust;
use App\User;

class ProvinsiController extends Controller
{
    public function index()
    {
        if (auth()->check() === false) {
            return redirect('login');
        }

        return view('dashboard');
    }


    public function provinsi()
    {
        $pageTitle = 'LSPPMI - Master Data';
        $crumbs = explode("/",$_SERVER["REQUEST_URI"]);

		return view('master.provinsi', compact('pageTitle','crumbs'));
    }

    

    
 
    public function AjaxProvinsiInsertData(Request $request)
    {
       
        $Provinsi = new Provinsi();
        $Provinsi->nm_provinsi = $request->get('nm_provinsi');
        // $Provinsi->id = $request->get('id_provinsi');
        

        if($request->get('id_provinsi')){
            
            $update =[];
            $update['id'] = $request->get('id_provinsi');
            $update['nm_provinsi'] = $request->get('nm_provinsi');
            if(Provinsi::whereId($request->get('id_provinsi'))->update($update)){
                
                return json_encode(array(
                    "status"=>200,
                    "message"=>"sukses"
                ));
            }else{
                // flash()->error('Maaf kelas sudah memenuhi kuota / kelas sudah ditutup pendaftarannya');
                return json_encode(array(
                    "status"=>500,
                    "message"=>"error"
                ));
            }
            
        }else{
            
            if ($Provinsi->save()) {
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


    public function AjaxProvinsiDeleteData(Request $request)
    {
       
    //    return $request->get('nm_provinsi');
       
        $deleted = Provinsi::find($request->get('id'))->delete();
            if($deleted){
                return json_encode(array(
                    "status"=>200
                ));
            }else{
                return json_encode(array(
                    "status"=>500
                ));
            }
       

        // if ($Provinsi->save()) {
        //     return json_encode(array(
        //         "status"=>200
        //     ));
		// } else {
        //     return json_encode(array(
        //         "status"=>500
        //     ));
		// }
       

    }


    public function AjaxProvinsiGetData()
    {
    
        return DataTables::of(Provinsi::all())->addColumn('action', function (Provinsi $provinsi) {
            $action = "<div class='btn-group'>";
            $action .= '<button id="edit" data-id="'.$provinsi->id.'" data-nama="'.$provinsi->nm_provinsi.'" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit ' . $provinsi->nm_provinsi . '"><i class="flaticon2 flaticon2-pen"></i></button>';
            $action .= '<button id="hapus"  data-id="'.$provinsi->id.'" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete ' . $provinsi->nm_provinsi . '"><i class="flaticon2 flaticon2-trash"></i></button>';
           
			$action .= "</div>";
			return $action;
		})->make(true);
    }

}
