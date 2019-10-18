<?php

namespace App\Http\Controllers\Management\CBT\Materi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\Modul;
use DataTables;
use Entrust;


class PembuatanModulController extends Controller
{
    public function index()
    {
        $pageTitle = 'LSPPMI - Kategori Program';
        $pageHeader = 'Kategori';
        $Title = 'ini adalah menu kategori';
        $status       = [
            '0'  => 'Non Aktif',
            '1' => 'Aktif'
        ];
        
        $crumbs = explode("/",$_SERVER["REQUEST_URI"]);
        
		return view('management.cbt.materi.modul', compact('pageTitle','Title','pageHeader','crumbs','status'));
    }

    public function AjaxModulGetData()
    {
       return DataTables::of(Kategori::all())->addColumn('action', function (Kategori $kategori) {
            $action = "<div class='btn-group'>";
            $action .= '<button id="edit" data-code="'.$kategori->code.'" data-id="'.$kategori->id.'" data-nama="'.$kategori->name.'" data-desc="'.$kategori->description.'" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit ' . $kategori->name . '"><i class="flaticon2 flaticon2-pen"></i></button>';
            $action .= '<button id="hapus"  data-id="'.$kategori->id.'" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete ' . $kategori->name . '"><i class="flaticon2 flaticon2-trash"></i></button>';
           
			$action .= "</div>";
			return $action;
		})->make(true);
    }
}
