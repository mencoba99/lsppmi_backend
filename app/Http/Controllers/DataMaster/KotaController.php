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
     * KotaController constructor.
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
        $provinsi     = Provinsi::orderBy('name', 'ASC')->pluck('name', 'id')->prepend('',''); //Dropdown Unit
		return view('DataMaster.KotaController.kota', compact('provinsi'));
    }

    public function AjaxKotaInsertData(Request $request)
    {
        /**
         * Parameter for insert db
         */
        $Kota = new Kota();
        $Kota->name = $request->get('nm_kota');
        $Kota->province_id = $request->get('id_provinsi');

        /**
         * Parameter for update db
         */
        if($request->get('id_kota')){

            $update =[];
            $update['id'] = $request->get('id_kota');
            $update['name'] = $request->get('nm_kota');
            /**
             * Trigger Update
             */
            if(Kota::whereId($request->get('id_kota'))->update($update)){
                /**
                 * Http Respond
                 */
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
            /**
             * Trigger Insert DB
             */
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
            if (auth()->user()->can('Kota Edit')) {
                $action .= '<button id="edit" data-id="'.$kota->id.'" data-nama="'.$kota->nm_kota.'" data-kode="'.$kota->kode_pos.'" data-provinsi="'.$kota->id_provinsi.'" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit ' . $kota->nm_kota . '"><i class="flaticon2 flaticon2-pen"></i></button>';
            }
            $action .= "</div>";
			return $action;
		})->make(true);
    }

    public function AjaxKotaDeleteData(Request $request)
    {

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
