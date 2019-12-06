<?php

namespace App\Http\Controllers\DataMaster;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Element;
use App\Models\Units;
use DataTables;
use Entrust;
use App\User;

class ElementController extends Controller
{

    /**
     *  ElementController Contruct
     */
    public function __construct()
    {
        $this->middleware(['permission:Elemen Kompetensi']);
    }

    public function index()
    {
        $unit     = Units::orderBy('name', 'ASC')->pluck('name', 'id')->prepend('',''); //Dropdown Unit
        return view('master.element',compact('unit'));
    }

    public function AjaxInsertData(Request $request)
    {
        /** Parameter Insert to DB */
        $Element = new Element();
        $Element->name = $request->get('name');
        $Element->code = $request->get('code');
        $Element->competence_unit_id = $request->get('unit');
        $Element->status = $request->get('status') ? TRUE : FALSE;

        /** Update to DB */
        if($request->get('id')){
            $update =[];
            $update['id'] = $request->get('id');
            $update['name'] = $request->get('name');
            $update['code'] = $request->get('code');
            $update['competence_unit_id'] = $request->get('unit');
            $update['status'] = $request->get('status') ? TRUE : FALSE;
            /** http respond */
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
            /** Trigger for Insert DB */
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
        /** Get Data for Datatable */
        $Element = Element::with(['units'])->get();
        return DataTables::of($Element)->addColumn('action', function (Element $Element) {
            $action = "<div class='btn-group'>";
            if (auth()->user()->can('Elemen Kompetensi Edit')) {
                $action .= '<button id="edit" data-id="'.$Element->id.'" data-status="'.$Element->status.'" data-name="'.$Element->name.'" data-code="'.$Element->code.'" data-unit="'.$Element->competence_unit_id.'" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit ' . $Element->nm_Element . '"><i class="flaticon2 flaticon2-pen"></i></button>';
            }
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
