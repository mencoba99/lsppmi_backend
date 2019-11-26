<?php

namespace App\Http\Controllers\DataMaster;

use App\Http\Controllers\Controller;
use App\Models\TUK;
use App\Models\Units;
use App\Models\KUK;
use App\Models\Element;
use App\Models\DataMaster\Tertulis;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use function foo\func;

class TertulisController extends Controller
{
    /**
     * TertulisController constructor.
     * Set default permission access
     */
    public function __construct()
    {
        $this->middleware(['permission:Pertanyaan Tertulis']);
    }

    /**
     * Display a listing of the resource. List daftar TUK
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('DataMaster.TertulisController.index');
    }

    /**
     * Method untuk menampilkan data TUK untuk datatables pada halaman index
     *
     * @param DataTables $dataTables
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function Getdata(DataTables $dataTables)
    {
        $tertulis = Tertulis::query();
      
        $tertulisJson = $dataTables->eloquent($tertulis)->addColumn('action', function (Tertulis $tertulis) {
            $action = "<a href='" . route('tertulis.show', ['tertulis' => $tertulis]) . "' class='btn btn-sm btn-icon btn-clean btn-icon-sm modalIframe' data-toggle='kt-tooltip' title='View ".strip_tags($tertulis->pertanyaan)."' data-original-tooltip='View ".strip_tags($tertulis->pertanyaan)."'>
                              <i class='la la-search'></i>
                            </a>";
            if (auth()->user()->can('Pertanyaan Tertulis Edit')) {
                $action .= "<a href='" . route('tertulis.edit', ['tertulis' => $tertulis]) . "' class='btn btn-sm btn-icon btn-clean btn-icon-sm' data-toggle='kt-tooltip' title='Edit' data-original-tooltip='Edit'>
                              <i class='la la-edit'></i>
                            </a>";
            }
            if (auth()->user()->can('Pertanyaan Tertulis Delete')) {
                $action .= "<a href='" . route('tertulis.delete', ['tertulis' => $tertulis]) . "' class='btn btn-sm btn-icon btn-clean btn-icon-sm delconfirm' data-toggle='kt-tooltip' title='Hapus' data-original-tooltip='Hapus'>
                              <i class='la la-trash'></i>
                            </a>";
            }

            return $action;
        })->addColumn('element_id', function (Tertulis $tertulis) {
            return $tertulis->element->name;
        })->addColumn('kuk_id', function (Tertulis $tertulis) {
            return $tertulis->kuk->name;
        })->addColumn('tuk_id', function (Tertulis $tertulis) {
            return $tertulis->tuk->name;
        })->editColumn('unit_id', function (Tertulis $tertulis) {
            return $tertulis->unit->name;
        })->escapeColumns([])->make(true);

        return $tertulisJson;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tertulis       = null;
        $units = Units::all()->pluck('name', 'id');
        $tuk = TUK::all()->pluck('name', 'id');
        $kuk = KUK::all()->pluck('name', 'id');
        $element = Element::all()->pluck('name', 'id');
        return view('DataMaster.TertulisController.create', compact('units', 'tuk','tertulis','element','kuk'));
    }

   

    /**
     * Store a newly created resource in storage. Simpan data TUK
     *
     * @param \Illuminate\Http\Request $request
     * @return \Redirect to index
     */
    public function store(Request $request)
    {
        if (auth()->user()->can('Pertanyaan Tertulis Add')) {
            $request->validate([
                                   'unit_id'        => 'required',
                                   'tuk_id'     => 'required',
                                   'pertanyaan' => 'required',
                                   'jawaban'  => 'required',
                               ]);

            $tertulis = new Tertulis($request->all());

            if ($tertulis->save()) {
                flash()->success('Berhasil menyimpan data pertanyaan tertulis ke database');
            } else {
                flash()->error('Gagal menyimpan data pertanyaan tertulis ke database');
            }
        } else {
            flash()->error('Maaf, Anda tidak mempunyai akses untuk menambah data pertanyaan tertulis');
        }
        return redirect()->route('tertulis.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Tertulis $tertulis)
    {
        
        return view('DataMaster.TertulisController.show', compact('tertulis'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tertulis = Tertulis::find($id); 
        // return $tertulis->element->id; exit;
        if (auth()->user()->can('Pertanyaan Tertulis Edit')) {
            
            $units = Units::all()->pluck('name', 'id');
            $tuk = TUK::all()->pluck('name', 'id');
            $element = Element::where('competence_unit_id',$tertulis->unit_id)->pluck('name', 'id');
            $kuk = KUK::where('competence_element_id',$tertulis->element_id)->pluck('name', 'id');
            return view('DataMaster.TertulisController.edit', compact('units', 'tuk','tertulis','element','kuk'));
        } else {
            flash()->error('Maaf, Anda tidak mempunyai akses untuk mengubah pertanyaan tertulis');
        }
        return redirect()->route('tertulis.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Tertulis $tertulis
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tertulis $tertulis)
    {
       
        if (auth()->user()->can('Pertanyaan Tertulis Edit')) {
            $request->validate([
                                'unit_id'        => 'required',
                                'tuk_id'     => 'required',
                                'pertanyaan' => 'required',
                                'jawaban'  => 'required',
                               ]);
            if ($tertulis->update($request->all())) {
                flash()->success('Berhasil melakukan perubahan data pertanyaan tertulis');
            } else {
                flash()->error('Gagal mengubah data pertanyaan tertulis, mohon cek kembali data isian');
            }
        } else {
            flash()->error('Maaf, Anda tidak mempunyai akses untuk mengubah data pertanyaan tertulis');
        }
        return redirect()->route('tertulis.index');
    }

    /**
     * Get data Element | Ajax request
     *
     * @param Request $request
     * @return String json
     */

    public function getElement(Request $request)
    {
        $element_id = $request->get('competence_unit_id');

        $element = Element::where('competence_unit_id', $element_id)->get();
        $result  = [];
        if ($element && $element->count() > 0) {
            foreach ($element as $item) {
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
     * Get data KUK | Ajax request
     *
     * @param Request $request
     * @return String json
     */

    public function getKUK(Request $request)
    {
        $kuk_id = $request->get('competence_element_id');

        $kuk = KUK::where('competence_element_id', $kuk_id)->get();
        $result  = [];
        if ($kuk && $kuk->count() > 0) {
            foreach ($kuk as $item) {
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
     * Remove the specified resource from storage.
     *
     * @param Tertulis $tertulis
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function delete(Tertulis $tertulis)
    {
        
        if (auth()->user()->can('Pertanyaan Tertulis Delete')) {
            if ($tertulis->delete()) {
                flash()->success('Berhasil menghapus data pertanyaan tertulis');
            } else {
                flash()->error('Gagal menghapus data pertanyaan tertulis');
            }
        } else {
            flash()->error('Maaf, Anda tidak mempunyai akses untuk menghapus data pertanyaan tertulis');
        }
        return redirect()->route('tertulis.index');
    }
}
