<?php

namespace App\Http\Controllers\Management\CBT;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\Kategori;
use DataTables;
use Entrust;



class KategoriController extends Controller
{
    //

    public function Kategori()
    {
        $pageTitle = 'LSPPMI - Kategori Program';
        $pageHeader = 'Kategori';
        $Title = 'ini adalah menu kategori';
        $status       = [
            '0'  => 'Non Aktif',
            '1' => 'Aktif'
        ];
        
        $crumbs = explode("/",$_SERVER["REQUEST_URI"]);
        
		return view('management.cbt.kategori', compact('pageTitle','Title','pageHeader','crumbs','status'));
    }

    public function AjaxKategoriGetData()
    {
       return DataTables::of(Kategori::all())->addColumn('action', function (Kategori $kategori) {
            $action = "<div class='btn-group'>";
            $action .= '<button id="edit" data-status="'.$kategori->status.'"  data-code="'.$kategori->code.'" data-id="'.$kategori->id.'" data-nama="'.$kategori->name.'" data-desc="'.$kategori->description.'" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit ' . $kategori->name . '"><i class="flaticon2 flaticon2-pen"></i></button>';
            // $action .= '<button id="view"  data-id="'.$kategori->id.'" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="View ' . $kategori->name . '"><i class="flaticon2 flaticon2-search"></i></button>';
           
			$action .= "</div>";
			return $action;
		})->addColumn('status', function (Kategori $kategori) {
            
            if($kategori->status==1){
                return "Aktif";
            }else{
                return "Non Aktif";
            }

		})->make(true);
    }

    public function AjaxKategoriDeleteData(Request $request)
    {
       
        $deleted = Kategori::find($request->get('id'))->delete();
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

    public function AjaxKategoriInsertData(Request $request)
    {
       
        $Kategori = new Kategori();
        $Kategori->name = $request->get('name');
        $Kategori->description = $request->get('desc');
        $Kategori->code = $request->get('code');
        $Kategori->status = $request->get('status');
        

        if($request->get('id')){
            
            $update =[];
            $update['id'] = $request->get('id');
            $update['name'] = $request->get('name');
            $update['code'] = $request->get('code');
            $update['description'] = $request->get('desc');
            $update['status'] = $request->get('status');
            if(Kategori::whereId($request->get('id'))->update($update)){
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
            
            if ($Kategori->save()) {
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
