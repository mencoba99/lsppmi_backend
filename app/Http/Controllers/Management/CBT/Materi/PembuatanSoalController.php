<?php

namespace App\Http\Controllers\Management\CBT\Materi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
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
        
        // $encrypted = Crypt::encryptString('a');
		// $decrypted = Crypt::decryptString($dataSoal[0]->a);
 
		// echo "Hasil Enkripsi : " . $encrypted;
		// echo "<br/>";
		// echo "<br/>";
        // echo "Hasil asli : " . $dataSoal[0]->a;
        // echo "<br/>";
        // echo "Hasil Dekripsi : " . $decrypted;
        
        // exit;


       return DataTables::of($dataSoal)->addColumn('action', function (Soal $Soal) {
            $action = "<div class='btn-group'>";
            $action .= '<button id="edit" data-jawaban="'.$Soal->kunci_id.'"  data-bobot="'.$Soal->jenis_soal_id.'"  data-desc="'.Crypt::decryptString($Soal->penjelasan).'"  data-status="'.$Soal->status.'"  data-tag="'.$Soal->tag.'"  data-e="'.Crypt::decryptString($Soal->e).'"   data-d="'.Crypt::decryptString($Soal->d).'"  data-c="'.Crypt::decryptString($Soal->c).'" data-b="'.Crypt::decryptString($Soal->b).'"  data-a="'.Crypt::decryptString($Soal->a).'" data-soal="'.Crypt::decryptString($Soal->soal).'" data-nick="'.$Soal->nick.'"  data-id="'.$Soal->soal_id.'"  data-modul="'.$Soal->modul_id.'" data-submodul="'.$Soal->submodul_id.'"  class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit ' . $Soal->name . '"><i class="flaticon2 flaticon2-pen"></i></button>';
            $action .= '<button id="hapus"  data-id="'.$Soal->id.'" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete ' . $Soal->name . '"><i class="flaticon2 flaticon2-trash"></i></button>';
           
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

    public function AjaxGetSubmodul(Request $request)
    {
       
        $submodul = [];
        $getsubModul = SubModul::where('id_modul',$request->id_modul)->get();
        // foreach ($getsubModul as $key1 => $value1) {
        //      return json_encode(array(
        //     "id"=>$value1->id,
        //     "name"=>$submvalue1odul->name
        //     ));
           
        // }
        
        // return json_encode(array(
        //     "id"=>$submodul->id,
        //     "name"=>$submodul->name
        // ));
       return  $getsubModul;
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
       
        $a = (string) $request->get('answer_a');
        $b = (string) $request->get('answer_b');
        $c = (string) $request->get('answer_c');
        $d = (string) $request->get('answer_d');
        $e = (string) $request->get('answer_e');

        $Soal = new Soal();
        $Soal->nick = $request->get('nick');
        $Soal->soal = Crypt::encryptString((string)$request->get('soal'));
        $Soal->a = Crypt::encryptString($a);
        $Soal->b = Crypt::encryptString($b);
        $Soal->c = Crypt::encryptString($c);
        $Soal->d = Crypt::encryptString($d);
        $Soal->e = Crypt::encryptString($e);
        $Soal->tag = $request->get('tag');
        $Soal->penjelasan = Crypt::encryptString($request->get('desc'));
        $Soal->kunci_id = $request->get('answer');
        $Soal->jenis_soal_id = $request->get('bobot');
        $Soal->hit              = '0';
        $Soal->status = $request->get('status');
        $Soal->aktif = $request->get('aktif');
        $Soal->parent = $request->get('parent');
        $Soal->modul_id = $request->get('modul_id');
        $Soal->submodul_id = $request->get('submodul');
       
        // exit;
        
        
        if($request->get('id')){ // for update
            
            $update =[];
            $update['nick'] = $request->get('nick');
            $update['soal'] = Crypt::encryptString($request->get('soal'));
            $update['a'] = Crypt::encryptString($request->get('answer_a'));
            $update['b'] = Crypt::encryptString($request->get('answer_b'));
            $update['c'] = Crypt::encryptString($request->get('answer_c'));
            $update['d'] = Crypt::encryptString($request->get('answer_d'));
            $update['e'] = Crypt::encryptString($request->get('answer_e'));
            $update['tag'] = $request->get('tag');
            $update['penjelasan'] = Crypt::encryptString($request->get('desc'));
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
