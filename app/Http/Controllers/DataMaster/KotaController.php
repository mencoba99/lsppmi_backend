<?php

namespace App\Http\Controllers\DataMaster;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Kota;
use App\Models\Provinsi;
use DataTables;
use Entrust;
use App\User;

class KotaController extends Controller
{
    /**
     * ProvinsiController constructor.
     */
    public function __construct()
    {
        $this->middleware(['permission:Kota']);
    }

    public function index()
    {
        if (auth()->check() === false) {
            return redirect('login');
        }

        return view('master.kota');
    }

    public function ProvinsiJson(){
        $Provinsi = Provinsi::orderBy('province_id')->get();
        return $Provinsi;

    }

    public function kota()
    {
        $pageTitle = 'LSPPMI - Master Kota';
        $data = Provinsi::all();
        $crumbs = explode("/",$_SERVER["REQUEST_URI"]);
                    $provinsi             = [];
				foreach ($data as $value) {
					$provinsi[ $value->id ] = $value->name;
				}

		return view('DataMaster.KotaController.kota', compact('pageTitle','provinsi','crumbs'));
    }

    public function AjaxKotaInsertData(Request $request)
    {

        $Kota = new Kota();
        $Kota->name = $request->get('nm_kota');
        $Kota->province_id = $request->get('id_provinsi');


        if($request->get('id_kota')){

            $update =[];
            $update['id'] = $request->get('id_kota');
            $update['name'] = $request->get('nm_kota');

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
        $kota = Kota::with(['provinsi'])->orderBy('province_id')->get();

        return DataTables::of($kota)->addColumn('action', function (Kota $kota) {
            $action = "<div class='btn-group'>";
            $action .= '<button id="edit" data-id="'.$kota->id.'" data-nama="'.$kota->nm_kota.'" data-kode="'.$kota->kode_pos.'" data-provinsi="'.$kota->id_provinsi.'" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit ' . $kota->nm_kota . '"><i class="flaticon2 flaticon2-pen"></i></button>';
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
