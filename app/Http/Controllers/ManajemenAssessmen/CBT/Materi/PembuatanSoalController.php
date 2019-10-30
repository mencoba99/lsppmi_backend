<?php

namespace App\Http\Controllers\ManajemenAssessmen\CBT\Materi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\Soal;
use App\Models\Modul;
use App\Models\Modul_soal;
use App\Models\SubModul;
use App\Models\SoalJenis;
use App\Helpers\Encryption_decryp_soal;
use DataTables;
use Entrust;


class PembuatanSoalController extends Controller
{
    public function index()
    {
        $pageTitle = 'LSPPMI - Soal Program';
        $pageHeader = 'Soal';
        $Title = 'ini adalah menu Soal';
        $status       = [
            '0'  => 'Non Aktif',
            '1' => 'Aktif'
        ];

        $bobot = [];
        $getBobot = SoalJenis::all();
        foreach ($getBobot as $key2 => $value2) {
            $bobot[$value2->id]=$value2->name;
        }



        $modul = [];
        $getModul = Modul::all();
        foreach ($getModul as $key => $value) {
            $modul[$value->id]=$value->name;
        }

        $submodul = [];
        $getsubModul = SubModul::all();
        foreach ($getsubModul as $key1 => $value1) {
            $submodul[$value1->id]=$value1->name;
        }

        $parent = '';

        $crumbs = explode("/",$_SERVER["REQUEST_URI"]);

		return view('management.cbt.materi.soal', compact('pageTitle','Title','pageHeader','crumbs','status','modul','submodul','bobot','parent'));
    }

    public function AjaxPembuatanSoalGetData()
    {
        $dataSoal = Soal::with('modul','submodul')->get();


       return DataTables::of($dataSoal)->addColumn('action', function (Soal $Soal) {
            $action = "<div class='btn-group'>";
            $action .= '<button id="edit" data-jawaban="'.$Soal->kunci_id.'"  data-bobot="'.$Soal->jenis_soal_id.'"  data-desc="'.$Soal->penjelasan.'"  data-status="'.$Soal->status.'"  data-tag="'.$Soal->tag.'"  data-e="'.$Soal->e.'"   data-d="'.$Soal->d.'"  data-c="'.$Soal->c.'" data-b="'.$Soal->b.'"  data-a="'.$Soal->a.'" data-soal="'.$Soal->soal.'" data-nick="'.$Soal->nick.'"  data-id="'.$Soal->soal_id.'"  data-modul="'.$Soal->modul_id.'" data-submodul="'.$Soal->submodul_id.'"  class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit ' . $Soal->name . '"><i class="flaticon2 flaticon2-pen"></i></button>';
            // $action .= '<button id="hapus"  data-id="'.$Soal->id.'" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete ' . $Soal->name . '"><i class="flaticon2 flaticon2-trash"></i></button>';

			$action .= "</div>";
			return $action;
		})->addColumn('status', function (Soal $Soal) {

            if($Soal->status==1){
                return "Aktif";
            }else{
                return "Non Aktif";
            }

		})->addColumn('modul', function (Soal $Soal) {

            if($Soal->modul_id){
                $data = Modul::find($Soal->modul_id)->first();
                return $data->name;
            }


		})->addColumn('submodul', function (Soal $Soal) {

            if($Soal->submodul_id){
                $data = SubModul::find($Soal->submodul_id)->first();
                return $data->name;
            }

		})->addColumn('bobot', function (Soal $Soal) {

            $data = SoalJenis::find($Soal->jenis_soal_id)->first();
            return $data->name;

		})->make(true);
    }

    public function AjaxPembuatanSoalDeleteData(Request $request)
    {

        $deleted = Soal::find($request->get('id'))->delete();
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

    public function AjaxPembuatanSoalInsertData(Request $request)
    {

        $Soal = new Soal();
        $Soal->nick = $request->get('nick');
        $Soal->soal = $request->get('soal');
        $Soal->a = $request->get('answer_a');
        $Soal->b = $request->get('answer_b');
        $Soal->c = $request->get('answer_c');
        $Soal->d = $request->get('answer_d');
        $Soal->e = $request->get('answer_e');
        $Soal->tag = $request->get('tag');
        $Soal->penjelasan = $request->get('desc');
        $Soal->kunci_id = $request->get('answer');
        $Soal->jenis_soal_id = $request->get('bobot');
        $Soal->hit              = '0';
        $Soal->status = $request->get('status');
        $Soal->aktif = $request->get('aktif');
        $Soal->parent = $request->get('parent');
        $Soal->modul_id = $request->get('modul_id');
        $Soal->submodul_id = $request->get('submodul');




        if($request->get('id')){ // for update

            $update =[];
            $update['nick'] = $request->get('nick');
            $update['soal'] = $request->get('soal');
            $update['a'] = $request->get('answer_a');
            $update['b'] = $request->get('answer_b');
            $update['c'] = $request->get('answer_c');
            $update['d'] = $request->get('answer_d');
            $update['e'] = $request->get('answer_e');
            $update['tag'] = $request->get('tag');
            $update['penjelasan'] = $request->get('desc');
            $update['kunci_id'] = $request->get('answer');
            $update['jenis_soal_id'] = $request->get('bobot');
            $update['modul_id'] = $request->get('modul_id');
            $update['submodul_id'] = $request->get('submodul');

            $update['status'] = $request->get('status');
            $update['aktif'] = $request->get('aktif');
            $update['parent'] = $request->get('parent');
            if(Soal::whereSoalId($request->get('id'))->update($update)){
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

            if ($Soal->save()) {
                $Modul_soal                       = new Modul_soal();
                $Modul_soal->modul_id        = $request->get('modul_id');
                $Modul_soal->submodul_id          = $request->get('submodul');
                $Modul_soal->soal_id              = $Soal->soal_id;
                if($Modul_soal->save()){
                    return json_encode(array(
                        "status"=>200,
                        "message"=>"sukses"
                    ));
                }
            } else {
                return json_encode(array(
                    "status"=>500
                ));
            }


        }



    }
}
