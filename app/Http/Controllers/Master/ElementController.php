<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Element;
use App\Models\Units;
use DataTables;
use Entrust;
use App\User;

class ElementController extends Controller
{
   


    public function index()
    {
        $pageTitle = 'LSPPMI - Master Element';
        $data = Units::all();
        $crumbs = explode("/",$_SERVER["REQUEST_URI"]);
                    $unit             = [];
				foreach ($data as $value) {
					$unit[ $value->id ] = $value->name;
				}

		return view('master.Element', compact('pageTitle','unit','crumbs'));
    }
 
    public function AjaxInsertData(Request $request)
    {
       
        $Element = new Element();
        $Element->name = $request->get('name');
        $Element->code = $request->get('code');
        $Element->competence_unit_id = $request->get('unit');
        $Element->status = $request->get('status');
        

        if($request->get('id')){
            
            $update =[];
            $update['id'] = $request->get('id');
            $update['name'] = $request->get('name');
            $update['code'] = $request->get('code');
            $update['competence_unit_id'] = $request->get('unit');
            $update['status'] = $request->get('status');
           
            if(Element::whereId($request->get('id'))->update($update)){
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
            
            if ($Element->save()) {
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


    public function AjaxGetData()
    {
        $Element = Element::with(['units'])->get();
       
        
        return DataTables::of($Element)->addColumn('action', function (Element $Element) {
            $action = "<div class='btn-group'>";
            $action .= '<button id="edit" data-id="'.$Element->id.'" data-status="'.$Element->status.'" data-name="'.$Element->name.'" data-code="'.$Element->code.'" data-unit="'.$Element->competence_unit_id.'" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit ' . $Element->nm_Element . '"><i class="flaticon2 flaticon2-pen"></i></button>';
            $action .= "</div>";
			return $action;
		})->addColumn('status', function (Element $Element) {
            
            if($Element->status==1){
                return "Aktif";
            }else{
                return "Non Aktif";
            }

		})->make(true);
    }

   


}
