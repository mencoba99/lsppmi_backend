<?php

namespace App\Http\Controllers\DataMaster;

use App\Http\Controllers\Controller;
use App\Models\CompetenceUnit;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UnitKompetensiController extends Controller
{
    /**
     * UnitKompetensiController constructor.
     */
    public function __construct()
    {
        $this->middleware(['permission:Unit Kompetensi']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('DataMaster.UnitKompetensiController.index');
    }

    public function geUnitKompetensiData(DataTables $dataTables)
    {
        $unitKompetensi = CompetenceUnit::query();

        $unitKompetensiJson = $dataTables->eloquent($unitKompetensi)->addColumn('action', function (CompetenceUnit $unitKompetensi) {
            $action = "";
            if (auth()->user()->can('Unit Kompetensi Edit')) {
                $action .= "<a href='" . route('unit-kompetensi.edit', ['unit_kompetensi' => $unitKompetensi]) . "' class='btn btn-sm btn-icon btn-clean btn-icon-sm' data-toggle='kt-tooltip' title='Edit' data-original-tooltip='Edit'>
                              <i class='la la-edit'></i>
                            </a>";
            }
            if (auth()->user()->can('Unit Kompetensi Delete')) {
                $action .= "<a href='" . route('unit-kompetensi.delete', ['unit_kompetensi' => $unitKompetensi]) . "' class='btn btn-sm btn-icon btn-clean btn-icon-sm delconfirm' data-toggle='kt-tooltip' title='Hapus' data-original-tooltip='Hapus'>
                              <i class='la la-trash'></i>
                            </a>";
            }

            return $action;
        })->editColumn('status', function (CompetenceUnit $unitKompetensi) {
            if ($unitKompetensi->status == 1) {
                return '<button type="button" class="btn btn-brand btn-success btn-sm btn-elevate btn-circle btn-icon" data-original-title="Aktif" data-trigger="kt-tooltip"><i class="la la-check"></i></button>';
            } else {
                return '<button type="button" class="btn btn-brand btn-danger btn-sm btn-elevate btn-circle btn-icon" data-originak-title="Tidak Aktif" data-trigger="kt-tooltip"><i class="la la-close"></i></button>';
            }
        })->escapeColumns([])->make(true);

        return $unitKompetensiJson;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->can('Unit Kompetensi Add')) {
            $unitKompetensi = null;
            return view('DataMaster.UnitKompetensiController.create', compact('unitKompetensi'));
        } else {
            flash()->error('Maaf, Anda tidak memepunyai akses untuk menambah data Unit Kompetensi');
        }
        return redirect()->route('unit-kompetensi.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (auth()->user()->can('Unit Kompetensi Add')) {
            $request->validate([
                                   'code' => 'required',
                                   'name' => 'required',
                                   'type' => 'required',
                               ]);

            $unitKompetensi = new CompetenceUnit($request->all());
            if ($unitKompetensi->save()) {
                flash()->success('Berhasil menambah data Unit Kompetensi');
            } else {
                flash()->error('Gagal menambah data Unit Kompetensi');
            }
        } else {
            flash()->error('Maaf, Anda tidak memepunyai akses untuk menambah data Unit Kompetensi');
        }
        return redirect()->route('unit-kompetensi.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param CompetenceUnit $unitKompetensi
     * @return \Illuminate\Http\Response
     */
    public function edit(CompetenceUnit $unitKompetensi)
    {
        if (auth()->user()->can('Unit Kompetensi Edit')) {
            return view('DataMaster.UnitKompetensiController.create', compact('unitKompetensi'));
        } else {
            flash()->error('Maaf, Anda tidak memepunyai akses untuk mengubah data Unit Kompetensi');
        }
        return redirect()->route('unit-kompetensi.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param CompetenceUnit $unitKompetensi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CompetenceUnit $unitKompetensi)
    {
        if (auth()->user()->can('Unit Kompetensi Edit')) {
            $request->validate([
                                   'code' => 'required',
                                   'name' => 'required',
                                   'type' => 'required',
                               ]);

            $update           = $request->all();
            $status           = $request->get('status');
            $status           = !empty($status) ? $status : '0';
            $update['status'] = $status;

            if ($unitKompetensi->update($update)) {
                flash()->success('Berhasil mengubah data Unit Kompetensi');
            } else {
                flash()->error('Gagal mengubah data Unit Kompetensi');
            }

        } else {
            flash()->error('Maaf, Anda tidak memepunyai akses untuk mengubah data Unit Kompetensi');
        }
        return redirect()->route('unit-kompetensi.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param CompetenceUnit $unitKompetensi
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(CompetenceUnit $unitKompetensi)
    {
        if ($unitKompetensi->delete()) {
            flash()->success('Berhasil menghapus data Unit Kompetensi');
        } else {
            flash()->error('Gagal menghapus Unit Kompetensi');
        }
        return redirect()->route('unit-kompetensi.index');
    }
}
