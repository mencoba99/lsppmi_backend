<?php

namespace App\Http\Controllers\DataMaster;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Provinsi;
use App\Models\Kota;
use DataTables;
use Entrust;
use App\User;

class ProvinsiController extends Controller
{
    /**
     * ProvinsiController constructor.
     */
    public function __construct()
    {
        $this->middleware(['permission:Provinsi']);
    }

    public function index()
    {
        if (auth()->check() === false) {
            return redirect('login');
        }

        return view('dashboard');
    }


    public function provinsi()
    {
        return view('DataMaster.ProvinsiController.provinsi');
    }


    public function AjaxProvinsiInsertData(Request $request)
    {

        $Provinsi       = new Provinsi();
        $Provinsi->name = $request->get('nm_provinsi');

        if ($request->get('id_provinsi')) {

            $update         = [];
            $update['id']   = $request->get('id_provinsi');
            $update['name'] = $request->get('nm_provinsi');
            if (Provinsi::whereId($request->get('id_provinsi'))->update($update)) {

                return json_encode(array(
                    "status"  => 200,
                   "message" => "sukses"
                ));
            } else {
                return json_encode(array(
                    "status"  => 500,
                    "message" => "error"
                ));
            }

        } else {

            if ($Provinsi->save()) {
                return json_encode(array(
                    "status" => 200
                ));
            } else {
                return json_encode(array(
                    "status" => 500
                ));
            }
        }


    }


    public function AjaxProvinsiGetData()
    {

        return DataTables::of(Provinsi::all())->addColumn('action', function (Provinsi $provinsi) {
            $action = '';
            
                $action .= "<div class='btn-group'>";
                if (auth()->user()->can('Provinsi Edit')) {
                    $action .= '<button id="edit" data-id="' . $provinsi->id . '" data-nama="' . $provinsi->name . '" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit ' . $provinsi->nm_provinsi . '"><i class="flaticon2 flaticon2-pen"></i></button>';
                }
                $action .= "</div>";
            
            return $action;
        })->make(true);
    }

}
