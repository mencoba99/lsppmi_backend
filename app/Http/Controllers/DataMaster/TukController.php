<?php

namespace App\Http\Controllers\DataMaster;

use App\Http\Controllers\Controller;
use App\Models\Kota;
use App\Models\Provinsi;
use App\Models\TUK;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use function foo\func;

class TukController extends Controller
{
    /**
     * TukController constructor.
     * Set default permission access
     */
    public function __construct()
    {
        $this->middleware(['permission:Tempat Uji Kompetensi (TUK)']);
    }

    /**
     * Display a listing of the resource. List daftar TUK
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('DataMaster.TukController.index');
    }

    /**
     * Method untuk menampilkan data TUK untuk datatables pada halaman index
     *
     * @param DataTables $dataTables
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function getTukData(DataTables $dataTables)
    {
        $tuk = TUK::query();

        $tukJson = $dataTables->eloquent($tuk)->addColumn('action', function (TUK $tuk) {
            $action = "<a href='" . route('tuk.show', ['tuk' => $tuk]) . "' class='btn btn-sm btn-icon btn-clean btn-icon-sm modalIframe' data-toggle='kt-tooltip' title='View ".$tuk->name."' data-original-tooltip='View ".$tuk->name."'>
                              <i class='la la-search'></i>
                            </a>";
            if (auth()->user()->can('Tempat Uji Kompetensi (TUK) Edit')) {
                $action .= "<a href='" . route('tuk.edit', ['tuk' => $tuk]) . "' class='btn btn-sm btn-icon btn-clean btn-icon-sm' data-toggle='kt-tooltip' title='Edit' data-original-tooltip='Edit'>
                              <i class='la la-edit'></i>
                            </a>";
            }
            if (auth()->user()->can('Tempat Uji Kompetensi (TUK) Delete')) {
                $action .= "<a href='" . route('tuk.delete', ['tuk' => $tuk]) . "' class='btn btn-sm btn-icon btn-clean btn-icon-sm delconfirm' data-toggle='kt-tooltip' title='Hapus' data-original-tooltip='Hapus'>
                              <i class='la la-trash'></i>
                            </a>";
            }

            return $action;
        })->addColumn('province_id', function (TUK $tuk) {
            return $tuk->regency->provinsi->name;
        })->editColumn('regency_id', function (TUK $tuk) {
            return $tuk->regency->name;
        })->escapeColumns([])->make(true);

        return $tukJson;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tuk       = null;
        $provinces = Provinsi::all()->pluck('name', 'id');
        $regencies = Kota::all()->pluck('name', 'id');
        return view('DataMaster.TukController.create', compact('tuk', 'provinces', 'regencies'));
    }

    /**
     * Get data Regency | Ajax request
     *
     * @param Request $request
     * @return String json
     */
    public function getRegency(Request $request)
    {
        $province_id = $request->get('province_id');

        $regency = Kota::where('province_id', $province_id)->get();
        $result  = [];
        if ($regency && $regency->count() > 0) {
            foreach ($regency as $item) {
                $result[] = [
                    'id'   => $item->id,
                    'text' => $item->name
                ];
            }
        } else {
            $result[] = ['id' => 0, 'text' => 'No Data'];
        }
        echo json_encode($result);
    }

    /**
     * Store a newly created resource in storage. Simpan data TUK
     *
     * @param \Illuminate\Http\Request $request
     * @return \Redirect to index
     */
    public function store(Request $request)
    {
        if (auth()->user()->can('Tempat Uji Kompetensi (TUK) Add')) {
            $request->validate([
                                   'name'        => 'required',
                                   'address'     => 'required',
                                   'province_id' => 'required',
                                   'regency_id'  => 'required',
                               ]);

            $tuk = new TUK($request->all());

            if ($tuk->save()) {
                flash()->success('Berhasil menyimpan data TUK ke database');
            } else {
                flash()->error('Gagal menyimpan data TUK ke database');
            }
        } else {
            flash()->error('Maaf, Anda tidak mempunyai akses untuk menambah data TUK');
        }
        return redirect()->route('tuk.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(TUK $tuk)
    {
        return view('DataMaster.TukController.show', compact('tuk'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(TUK $tuk)
    {
        if (auth()->user()->can('Tempat Uji Kompetensi (TUK) Edit')) {
            $provinces = Provinsi::all()->pluck('name', 'id');
            $regencies = Kota::where('province_id', $tuk->regency->provinsi->id)->pluck('name', 'id');
            return view('DataMaster.TukController.edit', compact('tuk', 'provinces', 'regencies'));
        } else {
            flash()->error('Maaf, Anda tidak mempunyai akses untuk mengubah TUK');
        }
        return redirect()->route('tuk.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param TUK $tuk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TUK $tuk)
    {
        if (auth()->user()->can('Tempat Uji Kompetensi (TUK) Edit')) {
            $request->validate([
                                   'name'        => 'required',
                                   'address'     => 'required',
                                   'province_id' => 'required',
                                   'regency_id'  => 'required',
                               ]);
            if ($tuk->update($request->all())) {
                flash()->success('Berhasil melakukan perubahan data TUK');
            } else {
                flash()->error('Gagal mengubah data TUK, mohon cek kembali data isian');
            }
        } else {
            flash()->error('Maaf, Anda tidak mempunyai akses untuk mengubah data TUK');
        }
        return redirect()->route('tuk.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param TUK $tuk
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function delete(TUK $tuk)
    {
        if (auth()->user()->can('Tempat Uji Kompetensi (TUK) Delete')) {
            if ($tuk->delete()) {
                flash()->success('Berhasil menghapus data TUK');
            } else {
                flash()->error('Gagal menghapus data TUK');
            }
        } else {
            flash()->error('Maaf, Anda tidak mempunyai akses untuk menghapus data TUK');
        }
        return redirect()->route('tuk.index');
    }
}
