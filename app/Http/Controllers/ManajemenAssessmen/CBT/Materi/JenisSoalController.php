<?php

namespace App\Http\Controllers\ManajemenAssessmen\CBT\Materi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\SoalJenis;
use DataTables;
use Entrust;


class JenisSoalController extends Controller
{
    public function index()
    {
        $pageTitle = 'LSPPMI - JenisSoal Program';
        $pageHeader = 'JenisSoal';
        $Title = 'ini adalah menu JenisSoal';
        $status       = [
            '0'  => 'Non Aktif',
            '1' => 'Aktif'
        ];

        $crumbs = explode("/",$_SERVER["REQUEST_URI"]);

		return view('ManajemenAssessmen.cbt.materi.jenissoal', compact('pageTitle','Title','pageHeader','crumbs','status'));
    }

    public function AjaxJenisSoalGetData()
    {
       return DataTables::of(SoalJenis::all())->addColumn('action', function (SoalJenis $JenisSoal) {
            $action = "<div class='btn-group'>";
            $action .= '<button id="edit"  data-id="'.$JenisSoal->id.'" data-nama="'.$JenisSoal->name.'" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit ' . $JenisSoal->name . '"><i class="flaticon2 flaticon2-pen"></i></button>';
            // $action .= '<button id="hapus"  data-id="'.$JenisSoal->id.'" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete ' . $JenisSoal->name . '"><i class="flaticon2 flaticon2-trash"></i></button>';

			$action .= "</div>";
			return $action;
		})->make(true);
    }

    public function AjaxJenisSoalDeleteData(Request $request)
    {

        $deleted = SoalJenis::find($request->get('id'))->delete();
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

    public function AjaxJenisSoalInsertData(Request $request)
    {

        $JenisSoal = new SoalJenis();
        $JenisSoal->name = $request->get('name');


        if($request->get('id')){ // for update

            $update =[];
            $update['id'] = $request->get('id');
            $update['name'] = $request->get('name');
            if(SoalJenis::whereId($request->get('id'))->update($update)){
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

            if ($JenisSoal->save()) {
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
