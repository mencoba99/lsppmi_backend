<?php

namespace App\Http\Controllers\ManajemenAssessmen\CBT;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\Program;
use App\Models\Kategori;
use DataTables;
use Entrust;

class ProgramController extends Controller
{
    /**
     * KategoriController constructor
     * 
     */

    public function __construct()
    {
        $this->middleware(['permission:Program']);
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function Program()
    {
        /** Kategori */
        $data = Kategori::all();
        $Kategori             = [];
        foreach ($data as $value) {
            $Kategori[ $value->id ] = $value->name;
        }
        /** level */
        $level       = [
            '1'  => '1',
            '2' => '2',
            '3' => '3',
            '4'  => '4',
            '5'  => '5',
            '6'  => '6',
            '7'  => '7',
            '8'  => '8',
            '9'  => '9',
            '10'  => '10'
        ];
        /** Status */
        $status       = [
            '0'  => 'Non Aktif',
            '1' => 'Aktif'
        ];
        

		return view('ManajemenAssessmen.cbt.program', compact('Kategori','level','status'));
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function AjaxProgramGetData()
    {
        $Data = Program::with(['kategori'])->get();

        return DataTables::of($Data)->addColumn('action', function (Program $Program) {
            /** kolom action */
            $action = "<div class='btn-group'>";
            if (auth()->user()->can('Program Edit')) {
                
                $action .= '<button id="edit" data-code="'.$Program->code.'" data-status="'.$Program->status.'" data-level="'.$Program->level.'" data-harga="'.$Program->harga.'" data-sing_ind="'.$Program->abbreviation_id.'" data-sing_int="'.$Program->abbreviation_en.'" data-kategori="'.$Program->program_type_id.'" data-id="'.$Program->id.'" data-nama="'.$Program->name.'"  class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit ' . $Program->name . '"><i class="flaticon2 flaticon2-pen"></i></button>';
            }
            // $action .= '<button id="hapus"  data-id="'.$Program->id.'" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete ' . $Program->name . '"><i class="flaticon2 flaticon2-trash"></i></button>';

			$action .= "</div>";
			return $action;
		})->addColumn('keterangan', function (Program $Program) {
            /** kolom keterangan */
            $string = strip_tags($Program->description);
            if (strlen($string) > 100) {

                // truncate string
                $stringCut = substr($string, 0, 30);
                $endPoint = strrpos($stringCut, ' ');

                $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                $string .= ' ... ';
            }
            return $string;

		})->addColumn('status', function (Program $Program) {
            /** kolom status */
            if($Program->status==1){
                return "Aktif";
            }else{
                return "Non Aktif";
            }

		})->make(true);
    }

    
    /** Get Keterangan */
    public function AjaxProgramGetDesc(Request $request)
    {
        $data = Program::find($request->get('id'));

        if ($data) {
            return json_encode(array(
                    "status"=>200,
                    "data"=>$data->description
            ));
        } else {
            return json_encode(array(
                    "status"=>500
            ));
        }


    }
    /** Delete Data */
    public function AjaxProgramDeleteData(Request $request)
    {
        if (auth()->user()->can('Program Delete')) {
            $deleted = Program::find($request->get('id'))->delete();
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

    public function AjaxProgramInsertData(Request $request)
    {
        
            $Program = new Program();
            $Program->program_type_id = $request->get('program_type_id');
            $Program->code = $request->get('code');
            $Program->name = $request->get('name');
            $Program->abbreviation_id = $request->get('sing_ind');
            $Program->abbreviation_en = $request->get('sing_int');
            $Program->min_competence = $request->get('min_competence');
            $Program->opt_competence = $request->get('opt_competence');
            $Program->status = $request->get('status');
            $Program->level = $request->get('level');
            $Program->type = json_encode(array(
                "type" =>$request->get('type'),
                "message"=>array($request->get('cbt'), $request->get('interview'))
            ));
            $Program->description = $request->get('desc');

            /** Update Data */
            if($request->get('id')){
                if (auth()->user()->can('Program Edit')) {
                    $update =[];
                    $update['id'] = $request->get('id');
                    $update['program_type_id'] = $request->get('program_type_id');
                    $update['code'] = $request->get('code');
                    $update['name'] = $request->get('name');
                    $update['abbreviation_id'] = $request->get('sing_ind');
                    $update['abbreviation_en'] = $request->get('sing_int');
                    $update['min_competence'] = $request->get('min_competence');
                    $update['opt_competence'] = $request->get('opt_competence');
                    $update['level'] = $request->get('level');
                    $update['status'] = $request->get('status');
                    $update['type'] = json_encode(array(
                        "type" =>$request->get('type'),
                        "message"=>array($request->get('cbt'), $request->get('interview'))
                    ));
                    $update['harga'] = $request->get('harga');
                    $update['description'] = $request->get('desc');


                    if(Program::whereId($request->get('id'))->update($update)){
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
                }

            }else{
                /** Insert Data */
                if (auth()->user()->can('Program Add')) {
                    if ($Program->save()) {
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
        
}
