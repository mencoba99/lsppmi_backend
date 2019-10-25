<?php

namespace App\Http\Controllers\Management\CBT;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\Program;
use App\Models\Kategori;
use DataTables;
use Entrust;

class ProgramController extends Controller
{
    
    public function Program()
    {
        $pageTitle = 'LSPPMI - Program ';
        $pageHeader = 'Program ';
        $Title = 'ini adalah menu Program';
        $data = Kategori::all();
        $Kategori             = [];
        foreach ($data as $value) {
            $Kategori[ $value->id ] = $value->name;
        }

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

        $status       = [
            '0'  => 'Non Aktif',
            '1' => 'Aktif'
        ];
        $crumbs = explode("/",$_SERVER["REQUEST_URI"]);

		return view('management.cbt.program', compact('pageTitle','Title','pageHeader','Kategori','level','status','crumbs'));
    }


    public function AjaxProgramGetData()
    {
        $Data = Program::with(['kategori'])->get();
        
        return DataTables::of($Data)->addColumn('action', function (Program $Program) {
            $action = "<div class='btn-group'>";
            $action .= '<button id="edit" data-code="'.$Program->code.'" data-status="'.$Program->status.'" data-level="'.$Program->level.'" data-harga="'.$Program->harga.'" data-sing_ind="'.$Program->abbreviation_id.'" data-sing_int="'.$Program->abbreviation_en.'" data-kategori="'.$Program->program_type_id.'" data-id="'.$Program->id.'" data-nama="'.$Program->name.'"  class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit ' . $Program->name . '"><i class="flaticon2 flaticon2-pen"></i></button>';
            // $action .= '<button id="hapus"  data-id="'.$Program->id.'" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete ' . $Program->name . '"><i class="flaticon2 flaticon2-trash"></i></button>';
           
			$action .= "</div>";
			return $action;
		})->addColumn('keterangan', function (Program $Program) {
            
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
            
            if($Program->status==1){
                return "Aktif";
            }else{
                return "Non Aktif";
            }

		})->make(true);
    }

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

    public function AjaxProgramDeleteData(Request $request)
    {
       
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

    public function AjaxProgramInsertData(Request $request)
    {
       
        $Program = new Program();
        $Program->program_type_id = $request->get('program_type_id');
        $Program->code = $request->get('code');
        $Program->name = $request->get('name');
        $Program->sing_ind = $request->get('sing_ind');
        $Program->sing_int = $request->get('sing_int');
        $Program->status = $request->get('status');
        $Program->level = $request->get('level');
        $Program->type = json_encode(array(
            "type" =>$request->get('type'),
            "message"=>array($request->get('cbt'), $request->get('interview'))
        ));
        $Program->description = $request->get('desc');
        

        if($request->get('id')){
            
            $update =[];
            $update['id'] = $request->get('id');
            $update['program_type_id'] = $request->get('program_type_id');
            $update['code'] = $request->get('code');
            $update['name'] = $request->get('name');
            $update['sing_ind'] = $request->get('sing_ind');
            $update['sing_int'] = $request->get('sing_int');
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
            
        }else{
            
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
