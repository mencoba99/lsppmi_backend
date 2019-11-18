<?php

namespace App\Http\Controllers\ManajemenAssessmen;

use App\Http\Controllers\Controller;
use App\Models\CompetenceUnit;
use App\Models\Program;
use App\Models\ProgramCompetenceUnit;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use function foo\func;

class PengaturanKompetensiController extends Controller
{
    /**
     * PengaturanKompetensiController constructor.
     */
    public function __construct()
    {
        $this->middleware(['permission:Pengaturan Kompetensi']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('ManajemenAssessmen.PengaturanKompetensiController.index');
    }

    /**
     * Fungsi untuk ambil data Program Unit Komptensi untuk di feed ke datatable
     *
     * @param DataTables $dataTables
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPengaturanKompetensiData(DataTables $dataTables)
    {
        $programUnit = Program::with('unit_kompetensi')->get();

        $programUnitJson = $dataTables->collection($programUnit)->addColumn('action', function (Program $program) {
            $action = '';
//            if (auth()->user()->can('Pengaturan Kompetensi Edit')) {
//                $action .= "<a href='" . route('pengaturan-kompetensi.edit', ['pengaturan_kompetensi' => $program]) . "' class='btn btn-sm btn-icon btn-clean btn-icon-sm' title='Edit'>
//                              <i class='la la-edit'></i>
//                            </a>";
//            }
//            if (auth()->user()->can('Pengaturan Kompetensi Delete')) {
//                $action .= "<a href='" . route('pengaturan-kompetensi.delete', ['pengaturan_kompetensi' => $program]) . "' class='btn btn-sm btn-icon btn-clean btn-icon-sm delconfirm' title='Hapus'>
//                              <i class='la la-trash'></i>
//                            </a>";
//            }

            return $action;
        })->editColumn('unit_kompetensi', function (Program $program) {
            $program->load('unit_kompetensi');
            $unitKompetensi    = $program->unit_kompetensi;
            $newUnitKompetensi = [];

            if (is_object($program->unit_kompetensi) && $program->unit_kompetensi->count() > 0) {
                foreach ($program->unit_kompetensi as $item) {
                    /** @var  $action | Untuk kolom Action Button */
                    $action = '';
                    if (auth()->user()->can('Pengaturan Kompetensi Edit')) {
                        $action .= "<a href='" . route('pengaturan-kompetensi.edit', ['pengaturan_kompetensi' => $item->pivot->id]) . "' class='btn btn-xs btn-icon btn-clean btn-icon-sm' title='Edit'>
                                      <i class='la la-edit'></i>
                                    </a>";
                    }
                    if (auth()->user()->can('Pengaturan Kompetensi Delete')) {
                        $action .= "<a href='" . route('pengaturan-kompetensi.delete', ['pengaturan_kompetensi' => $item->pivot->id]) . "' class='btn btn-xs btn-icon btn-clean btn-icon-sm delconfirm' title='Hapus'>
                                      <i class='la la-trash'></i>
                                    </a>";
                    }
                    $item['action'] = $action;

                    /** Untuk Kolom Status */
                    $status = '';
                    if ($item->status == 1) {
                        $status .= '<button type="button" class="btn btn-brand btn-elevate btn-circle btn-icon btn-sm" data-toggle="kt-tooltip" data-original-title="Aktif"><i class="la la-check"></i></button>';
                    } elseif ($item->status == 0) {
                        $status .= '<button type="button" class="btn btn-secondary btn-elevate btn-circle btn-icon btn-sm" data-toggle="kt-tooltip" data-original-title="Tidak Aktif"><i class="la la-check"></i></button>';
                    }
                    $item['status'] = $status;

                    $newUnitKompetensi[] = $item;
                }
            }
            return $newUnitKompetensi;
        })->editColumn('status', function (Program $program) {
            $status = '';
            /** Status Aktif atau tidak */
            if ($program->status == 1) {
                $status .= '<button type="button" class="btn btn-brand btn-elevate btn-circle btn-icon btn-sm" data-toggle="kt-tooltip" data-original-title="Aktif"><i class="la la-check"></i></button>';
            } elseif ($program->status == 0) {
                $status .= '<button type="button" class="btn btn-secondary btn-elevate btn-circle btn-icon btn-sm" data-toggle="kt-tooltip" data-original-title="Tidak Aktif"><i class="la la-check"></i></button>';
            }

            return $status;
        })->editColumn('is_required', function (Program $program) {
            return '';
        })->escapeColumns([])->setRowClass(function (Program $program) {
//            if ($program->unit_kompetensi && $program->unit_kompetensi()->count() > 0) return 'has-child';
//            else return '';
            return 'has-child';
        })->make(true);

        return $programUnitJson;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->can('Pengaturan Kompetensi Add')) {
            $programKompetensi = null;
            $programs          = Program::selectRaw("CONCAT(code,'( ',name,' ) ',' ') AS name, id")->active()->get()->pluck('name', 'id')->prepend('', '');
            $unitKompetensi    = CompetenceUnit::selectRaw("CONCAT(code,' - ',name,' ') AS name, id")->pluck('name', 'id')->prepend('', '');
            return view('ManajemenAssessmen.PengaturanKompetensiController.create', compact('programKompetensi', 'programs', 'unitKompetensi'));
        } else {
            flash()->error('Maaf, Anda tidak mempunyai akses untuk menambah data Pengaturan Kompetensi');
            return redirect()->route('pengaturan-kompetensi.index');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (auth()->user()->can('Pengaturan Kompetensi Add')) {
            $request->validate([
                                   'program_id'         => 'required',
                                   'competence_unit_id' => 'required',
                                   'is_required'        => 'required',
                               ]);

            $programCompetenceUnit = new ProgramCompetenceUnit($request->all());
            if ($programCompetenceUnit->save()) {
                flash()->success('Berhasil menambah Pengaturan Kompetensi');
            } else {
                flash()->error('Gagal menambah data Pengaturan Kompetensi');
            }
        } else {
            flash()->error('Maaf, Anda tidak mempunyai akses untuk menambah data Pengaturan Kompetensi');
        }
        return redirect()->route('pengaturan-kompetensi.index');
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
     * @param ProgramCompetenceUnit $programKompetensi
     * @return void
     */
    public function edit(ProgramCompetenceUnit $programKompetensi)
    {
        if (auth()->user()->can('Pengaturan Kompetensi Edit')) {
            $programs          = Program::selectRaw("CONCAT(code,'( ',name,' ) ',' ') AS name, id")->active()->get()->pluck('name', 'id')->prepend('', '');
            $unitKompetensi    = CompetenceUnit::selectRaw("CONCAT(code,' - ',name,' ') AS name, id")->pluck('name', 'id')->prepend('', '');
            return view('ManajemenAssessmen.PengaturanKompetensiController.edit', compact('programKompetensi', 'programs', 'unitKompetensi'));
        } else {
            flash()->error('Maaf, Anda tidak mempunyai akses untuk mengubah data Pengaturan Kompetensi');
            return redirect()->route('pengaturan-kompetensi.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProgramCompetenceUnit $programCompetenceUnit)
    {
        if (auth()->user()->can('Pengaturan Kompetensi Edit')) {
            $request->validate([
//                                   'program_id'         => 'required',
//                                   'competence_unit_id' => 'required',
                                   'is_required'        => 'required',
                               ]);

            $update = [
                'is_required' => $request->get('is_required')
            ];
            if ($programCompetenceUnit->update($update)) {
                flash()->success('Berhasil mengubah Pengaturan Kompetensi');
            } else {
                flash()->error('Gagal mengubah data Pengaturan Kompetensi');
            }
        } else {
            flash()->error('Maaf, Anda tidak mempunyai akses untuk mengubah data Pengaturan Kompetensi');
        }
        return redirect()->route('pengaturan-kompetensi.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy($id)
    {
        $programKompetensi = ProgramCompetenceUnit::find($id);
        if ($programKompetensi->delete()) {
            flash()->success('Berhasil menghapus data Pengaturan Kompetensi');
        } else {
            flash()->error('Gagal menghapus data Pengaturan Kompetensi');
        }
        return redirect()->route('pengaturan-kompetensi.index');
    }

    /**
     * Untuk proses Onchange pada kolom Program di form - dimaksudkan untuk hanya menampilkan data Unit kompetensi
     * yang memang belum dikaitkan dengan program yang sedang dipilih
     *
     * @param Request $request
     */
    public function getProgramUnitKompetensi(Request $request)
    {
        $program_id            = $request->get('program_id');
        $programUnitKompetensi = ProgramCompetenceUnit::where('program_id', $program_id)->get()->pluck('id');

        $unitKompetensi = CompetenceUnit::whereNotIn('id', $programUnitKompetensi)->get();

        $result = [];
        if ($unitKompetensi && $unitKompetensi->count() > 0) {
            foreach ($unitKompetensi as $item) {
                $result[] = [
                    'id'   => $item->id,
                    'text' => $item->code . ' - ' . $item->name
                ];
            }
        } else {
            $result[] = ['id' => 0, 'text' => 'No Data'];
        }
        echo json_encode($result);
    }
}
