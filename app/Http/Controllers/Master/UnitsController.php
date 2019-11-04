<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Units;
use App\Models\Kategori;
use DataTables;
use Entrust;
use App\User;

class UnitsController extends Controller
{
   


    public function index()
    {
        $pageTitle = 'LSPPMI - Master Units';
        $crumbs = explode("/",$_SERVER["REQUEST_URI"]);
                 

                $type = [];
                $get = Kategori::all();
                foreach ($get as $key2 => $value2) {
                    $type[$value2->id]=$value2->name;
                }

		return view('master.Units', compact('pageTitle','crumbs','type'));
    }
 
    public function AjaxInsertData(Request $request)
    {
       
        $Units = new Units();
        $Units->name = $request->get('name');
        $Units->code = $request->get('code');
        $Units->status = $request->get('status');
        $Units->type = $request->get('status');
        

        if($request->get('id')){
            
            $update =[];
            $update['id'] = $request->get('id');
            $update['name'] = $request->get('name');
            $update['code'] = $request->get('code');
            $update['type'] = $request->get('type');
            $update['status'] = $request->get('status');
           
            if(Units::whereId($request->get('id'))->update($update)){
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
            
            if ($Units->save()) {
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
        $Units = Units::with(['type'])->get();
       
        
        return DataTables::of($Units)->addColumn('action', function (Units $Units) {
            $action = "<div class='btn-group'>";
            $action .= '<button id="edit" data-id="'.$Units->id.'" data-status="'.$Units->status.'"  data-name="'.$Units->name.'" data-code="'.$Units->code.'" data-type="'.$Units->type.'" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit ' . $Units->nm_Units . '"><i class="flaticon2 flaticon2-pen"></i></button>';
            $action .= "</div>";
			return $action;
		})->addColumn('status', function (Units $Units) {
            
            if($Units->status==1){
                return "Aktif";
            }else{
                return "Non Aktif";
            }

		})->make(true);
    }

   


}
