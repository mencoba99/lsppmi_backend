<?php

namespace App\Http\Controllers\ManajemenAssessmen\CBT\Materi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\User;
use App\Imports\SoalImport;
use App\Models\Soal;
use App\Models\SoalTmp;
use App\Models\CompetenceKUK;
use App\Models\CompetenceElement;
use App\Models\CompetenceUnit;
use App\Models\Modul;
use App\Models\Modul_soal;
use App\Models\SubModul;
use App\Models\SoalJenis;
use App\Helpers\Encryption_decryp_soal;
use Excel;

use DataTables;
use Entrust;
use DB;


class PembuatanSoalController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:Pembuatan Soal']);
    }
    
    public function index()
    {
        
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

		return view('ManajemenAssessmen.cbt.materi.PembuatanSoalController.soal', compact('status','modul','submodul','bobot','parent'));
    }

    public function show(Request $request, $soal_id)
    {
        $soal = DB::table('soal')
                  ->select([
                        'soal.soal_id AS soal_id',
                        'competence_units.name AS nama_modul',
                        'competence_kuk.name AS nama_submodul',
                        'soal.nick AS nick',
                        'soal.soal AS soal',
                        'soal.a AS a',
                        'soal.b AS b',
                        'soal.c AS c',
                        'soal.d AS d',
                        'soal.e AS e',
                        'kunci.name AS kunci',
                        'soal.penjelasan AS penjelasan',
                        'soal_jenis.name AS jenis',
                        'soal.hit AS hit',
                        'soal.program_type AS kategori',
                        'soal.parent AS parent',
                        'soal.aktif AS aktif',
                        
                        ])
                  ->join('soal_jenis', 'soal_jenis.id', '=', 'soal.jenis_soal_id')
                  ->join('kunci', 'kunci.kunci_id', '=', 'soal.kunci_id')
                  ->leftJoin('modul_soal', 'modul_soal.soal_id', '=', 'soal.soal_id')
                  ->leftJoin('competence_units', 'competence_units.id', '=', 'modul_soal.modul_id')
                  ->leftJoin('competence_kuk', 'competence_kuk.id', '=', 'modul_soal.submodul_id')
                  ->where('soal.soal_id', $soal_id)
                  ->first();
        // return response()->json($soal) ; exit;
        return view('ManajemenAssessmen.cbt.materi.PembuatanSoalController.show', compact('soal'));
    }

    public function AjaxPembuatanSoalGetData()
    {
        $dataSoal = Soal::with('modul','submodul')->get();
        return DataTables::of($dataSoal)->addColumn('action', function (Soal $Soal) {
            $action = "<a href='" . route('materi.pembuatan-soal.show', ['soal' => $Soal]) . "' id='show' class='btn btn-sm btn-icon btn-clean btn-icon-sm modalIframe' data-toggle='kt-tooltip' >
                    <i class='la la-search'></i>
                    </a>";
            if (auth()->user()->can('Pembuatan Soal Edit')) {
                    $action .= '<button id="edit" data-parent="'.$Soal->parent.'" data-jawaban="'.$Soal->kunci_id.'"  data-bobot="'.$Soal->jenis_soal_id.'"  data-desc="'.Crypt::decryptString($Soal->penjelasan).'"  data-status="'.$Soal->status.'"  data-tag="'.$Soal->tag.'"  data-e="'.Crypt::decryptString($Soal->e).'"   data-d="'.Crypt::decryptString($Soal->d).'"  data-c="'.Crypt::decryptString($Soal->c).'" data-b="'.Crypt::decryptString($Soal->b).'"  data-a="'.Crypt::decryptString($Soal->a).'" data-soal="'.Crypt::decryptString($Soal->soal).'" data-nick="'.$Soal->nick.'"  data-id="'.$Soal->soal_id.'"  data-modul="'.$Soal->modul_id.'" data-submodul="'.$Soal->submodul_id.'"  class="btn btn-sm btn-clean btn-icon btn-icon-md" ><i class="flaticon2 flaticon2-pen"></i></button>';
            }
            if (auth()->user()->can('Pembuatan Soal Delete')) {
                    // $action .= '<button id="hapus"  data-id="'.$Soal->id.'" class="btn btn-sm btn-clean btn-icon btn-icon-md" ><i class="flaticon2 flaticon2-trash"></i></button>';
            }
            return $action;
		})->addColumn('status', function (Soal $Soal) {
            if($Soal->status==1){
                return "Aktif";
            }else{
                return "Non Aktif";
            }
		})->addColumn('modul', function (Soal $Soal) {
            $data = Modul::where('id',$Soal->modul_id)->first();
            if($data){
                return $data->name;
            }
		})->addColumn('submodul', function (Soal $Soal) {
            $data = SubModul::where('id',$Soal->submodul_id)->first();
            if($data){
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
        // $getsubModul = SubModul::with('modul')->where('modul.id',$request->id_modul)->get();

        $getsubModul = SubModul::select('competence_kuk.id','competence_kuk.name')
        ->join('competence_elements', 'competence_elements.id', '=', 'competence_kuk.competence_element_id')
        ->join('competence_units', 'competence_units.id', '=', 'competence_elements.competence_unit_id')
        ->where('competence_units.id',$request->id_modul)->get();
        
        
       return  $getsubModul;
    }

    public function AjaxPembuatanSoalDeleteData(Request $request)
    {
        if (auth()->user()->can('Pembuatan Soal Delete')) {
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
    }

    

    public function AjaxGetParent(Request $request){
      
            $modul_id      = $request->modul_id;
            $submodul_id   = $request->submodul_id;
            $jenis_soal_id = $request->jenis_soal_id;
            $soal_id       = $request->soal_id;
          
            $modul_soal    = Modul_soal::where('modul_id', $modul_id)->where('submodul_id', $submodul_id)->pluck('soal_id');
            // return $modul_soal; exit;
            /* jika proses create soal maka soal id null jika edit !null */
            if(!empty($soal_id))
            {
               
                $check         = Soal::whereIn('soal_id', $modul_soal)
                                               ->where('jenis_soal_id', $jenis_soal_id)
                                               ->where('parent', $soal_id)->get();
                /* jika soal ini telah menjadi parent return array kosong */
                if($check->count()) {
                    $soal = [];
                } else {
                    $soal          = Soal::select('soal.soal_id', 'soal.nick')
                                    ->where('aktif', true)
                                    ->where('soal_id', '!=', $soal_id)
                                    ->whereIn('soal_id', $modul_soal)
                                    ->where('jenis_soal_id', $jenis_soal_id)
                                    ->where('parent', 0)
                                    ->get()
                                    ->toArray();

                                    // return $soal; exit;
                }
            } else {
                $soal = Soal::select('soal.soal_id', 'soal.nick')->where('aktif',true)->whereIn('soal_id',$modul_soal)->where('jenis_soal_id',$jenis_soal_id)->where('parent',0)->get()->toArray();
                // $soal          = Soal::select('soal.soal_id', 'soal.nick')
                //                     ->where('aktif', true)
                //                     ->where('soal_id', $modul_soal)
                //                     ->where('jenis_soal_id', $jenis_soal_id)
                //                     ->where('parent', 0)
                //                     ->get()
                //                     ->toArray();
                // return $soal; exit;
                                   
            }
            // return $soal; exit;
            
            if(!empty($soal)){
                echo json_encode($soal);
            }else{
                echo json_encode(array());
            }

            
        
    }

    public function AjaxPembuatanSoalInsertData(Request $request)
    {
        
        $Soal = new Soal();
        $Soal->nick = $request->get('nick');
        $soal = (string)$request->get('soal');
        $Soal->soal = Crypt::encryptString($soal);

        $a = $request->get('a');
        $b = $request->get('b');
        $c = $request->get('c');
        $d = $request->get('d');
        $e = $request->get('e');

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




        if($request->get('id')){ // for update

            $update =[];
            $update['nick'] = $request->get('nick');
            $update['soal'] = Crypt::encryptString($soal);
            $update['a'] =  Crypt::encryptString($a);
            $update['b'] =  Crypt::encryptString($b);
            $update['c'] =  Crypt::encryptString($c);
            $update['d'] =  Crypt::encryptString($d);
            $update['e'] =  Crypt::encryptString($e);
            $update['tag'] = $request->get('tag');
            $update['penjelasan'] = Crypt::encryptString($request->get('desc'));
            $update['kunci_id'] = $request->get('answer');
            $update['jenis_soal_id'] = $request->get('bobot');
            $update['modul_id'] = $request->get('modul_id');
            $update['submodul_id'] = $request->get('submodul');
            $update['hit'] = 0;
            $update['parent'] = $Soal->parent = $request->get('parent');;

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

    public function ImportExcel(Request $request){

        $this->validate($request, [
			'file' => 'required|mimes:csv,xls,xlsx'
        ]);


        if (auth()->user()->can('Pembuatan Soal Add')) {
          
            $success_trans = false;

            $data = Excel::toArray(new SoalImport, request()->file('file')); 
            $array = collect(head($data))
            ->filter(function ($row, $key) {
                return $row['code_kuk'] != null;
            });

           
            foreach($array as $value){
                  $submodul = CompetenceKUK::where('code',$value['code_kuk'])->value('id');

                  if($submodul!=null){

                  $value['jenis_soal_id'] = SoalJenis::where('name',$value['jenis_soal'])->value('id');
                  $element = CompetenceKUK::where('id',$submodul)->value('competence_element_id');
                  $unit = CompetenceElement::where('id',$element)->value('competence_unit_id');
                  $value['modul_id'] = CompetenceUnit::where('id',$unit)->value('id');


                  $soal = new Soal();
                  $soal->modul_id = $value['modul_id'];
                  $soal->submodul_id = $submodul;
                  $soal->nick = $value['nama_soal'];
                  $soal->soal = Crypt::encryptString($value['soal']);
                  $soal->a = Crypt::encryptString($value['pilihan_a']);
                  $soal->b = Crypt::encryptString($value['pilihan_b']);
                  $soal->c = Crypt::encryptString($value['pilihan_c']);
                  $soal->d = Crypt::encryptString($value['pilihan_d']);
                  $soal->e = Crypt::encryptString($value['pilihan_e']);
                  $soal->tag = $value['tag'];
                  $soal->penjelasan = Crypt::encryptString($value['penjelasan']);
                  $soal->kunci_id = $value['jawaban'];
                  $soal->jenis_soal_id = $value['jenis_soal_id'];
                  $soal->parent = 0;
                  $soal->hit = 0;

                    if ($soal->save()) {
                    $Modul_soal                       = new Modul_soal();
                    $Modul_soal->modul_id        = $value['modul_id'];
                    $Modul_soal->submodul_id          = $submodul;
                    $Modul_soal->soal_id              = $soal->soal_id;
                    $Modul_soal->save();
                    } 
                   
                
                  }else{
                    $soalTmp = new SoalTmp();
                    $soalTmp->code_kuk = $value['code_kuk'];
                    $soalTmp->nick = $value['nama_soal'];
                    $soalTmp->soal = Crypt::encryptString($value['soal']);
                    $soalTmp->a = Crypt::encryptString($value['pilihan_a']);
                    $soalTmp->b = Crypt::encryptString($value['pilihan_b']);
                    $soalTmp->c = Crypt::encryptString($value['pilihan_c']);
                    $soalTmp->d = Crypt::encryptString($value['pilihan_d']);
                    $soalTmp->e = Crypt::encryptString($value['pilihan_e']);
                    $soalTmp->tag = $value['tag'];
                    $soalTmp->penjelasan = Crypt::encryptString($value['penjelasan']);
                    $soalTmp->kunci_id = $value['jawaban'];
                    $soalTmp->jenis_soal_id = $value['jenis_soal'];
                    $soalTmp->parent = 0;
                    $soalTmp->hit = 0;
                    $soalTmp->save();
                  }

                  $success_trans = true;
                 
            }
       

            if ($success_trans == true) {
                flash()->success('Berhasil import soal');
            }

        } else {
            flash()->error("Maaf, Anda tidak mempunyai akses untuk Upload Soal");
        }
    
        return redirect()->route('materi.pembuatan-soal');  
        
     
    }
}
