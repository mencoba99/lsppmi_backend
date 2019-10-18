<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Kota;
use App\Models\Provinsi;
use DataTables;
use Entrust;
use App\User;

class KotaController extends Controller
{
    public function index()
    {
        if (auth()->check() === false) {
            return redirect('login');
        }

        return view('master.kota');
    }

    public function ProvinsiJson(){
        $Provinsi = Provinsi::all();
        return $Provinsi;

    }

    public function kota()
    {
        $pageTitle = 'LSPPMI - Master Kota';
        $data = Provinsi::all();
        $crumbs = explode("/",$_SERVER["REQUEST_URI"]);
                    $provinsi             = [];
				foreach ($data as $value) {
					$provinsi[ $value->id ] = $value->nm_provinsi;
				}

		return view('master.kota', compact('pageTitle','provinsi','crumbs'));
    }
 
    public function AjaxKotaInsertData(Request $request)
    {
       
        $Kota = new Kota();
        $Kota->nm_kota = $request->get('nm_kota');
        $Kota->id_provinsi = $request->get('id_provinsi');
        $Kota->kode_pos = $request->get('pos_kd');
        

        if($request->get('id_kota')){
            
            $update =[];
            $update['id'] = $request->get('id_kota');
            $update['nm_kota'] = $request->get('nm_kota');
            $update['kode_pos'] = $request->get('pos_kd');
            if(Kota::whereId($request->get('id_kota'))->update($update)){
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
            
            if ($Kota->save()) {
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


    public function AjaxKotaGetData()
    {
        $kota = Kota::with(['provinsi'])->get();
       
        
        return DataTables::of($kota)->addColumn('action', function (Kota $kota) {
            $action = "<div class='btn-group'>";
            $action .= '<button id="edit" data-id="'.$kota->id.'" data-nama="'.$kota->nm_kota.'" data-kode="'.$kota->kode_pos.'" data-provinsi="'.$kota->id_provinsi.'" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit ' . $kota->nm_kota . '"><i class="flaticon2 flaticon2-pen"></i></button>';
            $action .= '<button id="hapus"  data-id="'.$kota->id.'" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete ' . $kota->nm_kota . '"><i class="flaticon2 flaticon2-trash"></i></button>';
           
			$action .= "</div>";
			return $action;
		})->make(true);
    }

    public function AjaxKotaDeleteData(Request $request)
    {
       
    //    return $request->get('nm_provinsi');
       
        $deleted = Kota::find($request->get('id'))->delete();
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