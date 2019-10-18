<?php

namespace App\Http\Controllers\Master\Program;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\Kategori;
use DataTables;
use Entrust;



class ManagementController extends Controller
{
    
    public function Management()
    {
        $pageTitle = 'LSPPMI - Management Program';
        $pageHeader = 'Management Program';
        $Title = 'ini adalah menu Management';

		return view('master.program.Management', compact('pageTitle','Title','pageHeader'));
    }

    public function AjaxManagementGetData()
    {
       
        
        return DataTables::of(Management::all())->addColumn('action', function (Management $Management) {
            $action = "<div class='btn-group'>";
            $action .= '<button id="edit" data-code="'.$Management->code.'" data-id="'.$Management->id.'" data-nama="'.$Management->name.'" data-desc="'.$Management->description.'" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit ' . $Management->name . '"><i class="flaticon2 flaticon2-pen"></i></button>';
            $action .= '<button id="hapus"  data-id="'.$Management->id.'" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete ' . $Management->name . '"><i class="flaticon2 flaticon2-trash"></i></button>';
           
			$action .= "</div>";
			return $action;
		})->make(true);
    }

    public function AjaxManagementDeleteData(Request $request)
    {
       
        $deleted = Management::find($request->get('id'))->delete();
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

    public function AjaxManagementInsertData(Request $request)
    {
       
        $Management = new Management();
        $Management->name = $request->get('name');
        $Management->description = $request->get('desc');
        $Management->code = $request->get('code');
        

        if($request->get('id')){
            
            $update =[];
            $update['id'] = $request->get('id');
            $update['name'] = $request->get('name');
            $update['description'] = $request->get('code');
            if(Management::whereId($request->get('id'))->update($update)){
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
            
            if ($Management->save()) {
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
