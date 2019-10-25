<?php

namespace App\Http\Controllers\Management\CBT;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\MgtProgram;
use App\Models\Program;
use App\Models\Modul;
use DataTables;
use Entrust;



class ManagementController extends Controller
{
    //

    public function index()
    {
        $pageTitle = 'LSPPMI - MgtProgram Program';
        $pageHeader = 'MgtProgram';
        $Title = 'ini adalah menu MgtProgram';
        $status       = [
            '0'  => 'Non Aktif',
            '1' => 'Aktif'
        ];
        
        $modul = Modul::with('submodul')->where('status',1)->get();
        $Program = [];
        $program = Program::where('status',1)->get();
        foreach ($program as $key => $value) {
            $Program[$value->id]=$value->name;
        }

        $crumbs = explode("/",$_SERVER["REQUEST_URI"]);
        
		return view('management.cbt.MgtProgram', compact('pageTitle','Title','pageHeader','crumbs','status','modul','Program'));
    }

    public function AjaxMgtProgramGetData()
    {

    $mgtProgram = MgtProgram::with('program','modul','submodul')->get();
    

       return DataTables::of($mgtProgram)->addColumn('action', function (MgtProgram $MgtProgram) {
            $action = "<div class='btn-group'>";
            $action .= '<button id="edit"   data-code="'.$MgtProgram->code.'" data-id="'.$MgtProgram->id.'" data-nama="'.$MgtProgram->name.'"  class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit ' . $MgtProgram->name . '"><i class="flaticon2 flaticon2-pen"></i></button>';
            // $action .= '<button id="view"  data-id="'.$MgtProgram->id.'" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="View ' . $MgtProgram->name . '"><i class="flaticon2 flaticon2-search"></i></button>';
           
			$action .= "</div>";
			return $action;
		})->make(true);
    }

    public function AjaxMgtProgramDeleteData(Request $request)
    {
       
        $deleted = MgtProgram::find($request->get('id'))->delete();
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

    public function AjaxMgtProgramInsertData(Request $request)
    {
       
        $MgtProgram = new MgtProgram();
        $MgtProgram->name = $request->get('name');
        $MgtProgram->description = $request->get('desc');
        $MgtProgram->code = $request->get('code');
        $MgtProgram->status = $request->get('status');
        

        if($request->get('id')){
            
            $update =[];
            $update['id'] = $request->get('id');
            $update['name'] = $request->get('name');
            $update['code'] = $request->get('code');
            $update['description'] = $request->get('desc');
            $update['status'] = $request->get('status');
            if(MgtProgram::whereId($request->get('id'))->update($update)){
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
            
            if ($MgtProgram->save()) {
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
