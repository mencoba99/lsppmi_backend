<?php

namespace App\Http\Controllers\DataMaster;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\KUK;
use App\Models\Element;
use DataTables;
use Entrust;
use App\User;

class KUKController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:Kerangka Unjuk Kerja']);
    }

    public function index()
    {
        $pageTitle = 'LSPPMI - Master KUK';
        $data = Element::all();
        $crumbs = explode("/",$_SERVER["REQUEST_URI"]);
                    $element             = [];
				foreach ($data as $value) {
					$element[ $value->id ] = $value->name;
                }
                

		return view('master.kuk', compact('pageTitle','element','crumbs'));
    }
 
    public function AjaxInsertData(Request $request)
    {
        /**
         * Parameter for Insert DB
         */
        $KUK = new KUK();
        $KUK->name = $request->get('name');
        $KUK->code = $request->get('code');
        $KUK->competence_element_id = $request->get('element');
        $KUK->status = $request->get('status');
        
        /**
         * Paremeter for Update DB
         */
        if($request->get('id')){
            
            $update =[];
            $update['id'] = $request->get('id');
            $update['name'] = $request->get('name');
            $update['code'] = $request->get('code');
            $update['competence_element_id'] = $request->get('element');
            $update['status'] = $request->get('status');
            /**
             * Trigger Update
             */
            if(KUK::whereId($request->get('id'))->update($update)){
                /**
                 * HTTP Response
                 */
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
            /**
             * Trigger Insert
             */
            if ($KUK->save()) {
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
        $KUK = KUK::with(['element'])->get();
        return DataTables::of($KUK)->addColumn('action', function (KUK $KUK) {
           
            $action = "<div class='btn-group'>";
            if (auth()->user()->can('Kerangka Unjuk Kerja Edit')) {
                $action .= '<button id="edit" data-id="'.$KUK->id.'" data-status="'.$KUK->status.'" data-name="'.$KUK->name.'" data-code="'.$KUK->code.'" data-element="'.$KUK->competence_element_id.'" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit ' . $KUK->nm_KUK . '"><i class="flaticon2 flaticon2-pen"></i></button>';
            }
            $action .= "</div>";
			return $action;
        
        })->addColumn('status', function (KUK $KUK) {
            
            if($KUK->status==1){
                return "Aktif";
            }else{
                return "Non Aktif";
            }

		})->make(true);
    }

   


}
