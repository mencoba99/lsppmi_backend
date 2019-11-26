<?php

namespace App\Http\Controllers\DataMaster;

use App\Http\Controllers\Controller;
use App\Models\TUK;
use App\Models\Units;
use App\Models\KUK;
use App\Models\Element;
use App\Models\DataMaster\Lisan;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use function foo\func;

class LisanController extends Controller
{
    /**
     * LisanController constructor.
     * Set default permission access
     */
    public function __construct()
    {
        $this->middleware(['permission:Pertanyaan Lisan']);
    }

    /**
     * Display a listing of the resource. List daftar TUK
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('DataMaster.LisanController.index');
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
        $lisan = Lisan::query();
      
        $lisanJson = $dataTables->eloquent($lisan)->addColumn('action', function (Lisan $lisan) {
            $action = "<a href='" . route('lisan.show', ['lisan'=> $lisan]) . "' class='btn btn-sm btn-icon btn-clean btn-icon-sm modalIframe' data-toggle='kt-tooltip' title='View ".strip_tags($lisan->pertanyaan)."' data-original-tooltip='View ".strip_tags($lisan->pertanyaan)."'>
                              <i class='la la-search'></i>
                            </a>";
            if (auth()->user()->can('Pertanyaan Lisan Edit')) {
                $action .= "<a href='" . route('lisan.edit', ['lisan'=> $lisan]) . "' class='btn btn-sm btn-icon btn-clean btn-icon-sm' data-toggle='kt-tooltip' title='Edit' data-original-tooltip='Edit'>
                              <i class='la la-edit'></i>
                            </a>";
            }
            if (auth()->user()->can('Pertanyaan Lisan Delete')) {
                $action .= "<a href='" . route('lisan.delete', ['lisan'=> $lisan]) . "' class='btn btn-sm btn-icon btn-clean btn-icon-sm delconfirm' data-toggle='kt-tooltip' title='Hapus' data-original-tooltip='Hapus'>
                              <i class='la la-trash'></i>
                            </a>";
            }

            return $action;

        })->addColumn('element_id', function (Lisan $lisan) {
            return $lisan->element->name;
        })->addColumn('kuk_id', function (Lisan $lisan) {
            return $lisan->kuk->name;
        })->addColumn('tuk_id', function (Lisan $lisan) {
            return $lisan->tuk->name;
        })->editColumn('unit_id', function (Lisan $lisan) {
            return $lisan->unit->name;
        })->escapeColumns([])->make(true);

        return $lisanJson;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lisan       = null;
        $units = Units::all()->pluck('name', 'id');
        $tuk = TUK::all()->pluck('name', 'id');
        $kuk = KUK::all()->pluck('name', 'id');
        $element = Element::all()->pluck('name', 'id');
        return view('DataMaster.LisanController.create', compact('units', 'tuk','lisan','element','kuk'));
    }

   

    /**
     * Store a newly created resource in storage. Simpan data TUK
     *
     * @param \Illuminate\Http\Request $request
     * @return \Redirect to index
     */
    public function store(Request $request)
    {
        if (auth()->user()->can('Pertanyaan Lisan Add')) {
            $request->validate([
                                   'unit_id'        => 'required',
                                   'tuk_id'     => 'required',
                                   'pertanyaan' => 'required',
                                   'jawaban'  => 'required',
                               ]);

            $lisan = new Lisan($request->all());

            if ($lisan->save()) {
                flash()->success('Berhasil menyimpan data pertanyaan Lisan ke database');
            } else {
                flash()->error('Gagal menyimpan data pertanyaan Lisan ke database');
            }
        } else {
            flash()->error('Maaf, Anda tidak mempunyai akses untuk menambah data pertanyaan Lisan');
        }
        return redirect()->route('lisan.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Lisan $lisan)
    {
        
        return view('DataMaster.LisanController.show', compact('lisan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lisan = Lisan::find($id); 
        // return $lisan->element->id; exit;
        if (auth()->user()->can('Pertanyaan Lisan Edit')) {
            
            $units = Units::all()->pluck('name', 'id');
            $tuk = TUK::all()->pluck('name', 'id');
            $element = Element::where('competence_unit_id',$lisan->unit_id)->pluck('name', 'id');
            $kuk = KUK::where('competence_element_id',$lisan->element_id)->pluck('name', 'id');
            return view('DataMaster.LisanController.edit', compact('units', 'tuk','lisan','element','kuk'));
        } else {
            flash()->error('Maaf, Anda tidak mempunyai akses untuk mengubah pertanyaan Lisan');
        }
        return redirect()->route('lisan.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Lisan $lisan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lisan $lisan)
    {
       
        if (auth()->user()->can('Pertanyaan Lisan Edit')) {
            $request->validate([
                                'unit_id'        => 'required',
                                'tuk_id'     => 'required',
                                'pertanyaan' => 'required',
                                'jawaban'  => 'required',
                               ]);
            if ($lisan->update($request->all())) {
                flash()->success('Berhasil melakukan perubahan data pertanyaan Lisan');
            } else {
                flash()->error('Gagal mengubah data pertanyaan Lisan, mohon cek kembali data isian');
            }
        } else {
            flash()->error('Maaf, Anda tidak mempunyai akses untuk mengubah data pertanyaan Lisan');
        }
        return redirect()->route('lisan.index');
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
     * @param Lisan $lisan
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function delete(Lisan $lisan)
    {
        
        if (auth()->user()->can('Pertanyaan Lisan Delete')) {
            if ($lisan->delete()) {
                flash()->success('Berhasil menghapus data pertanyaan Lisan');
            } else {
                flash()->error('Gagal menghapus data pertanyaan Lisan');
            }
        } else {
            flash()->error('Maaf, Anda tidak mempunyai akses untuk menghapus data pertanyaan Lisan');
        }
        return redirect()->route('lisan.index');
    }
}
