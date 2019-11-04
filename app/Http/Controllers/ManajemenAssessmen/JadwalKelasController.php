<?php

namespace App\Http\Controllers\ManajemenAssessmen;

use App\Http\Controllers\Controller;
use App\Models\JadwalKelas;
use App\Models\Program;
use App\Models\TUK;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use function GuzzleHttp\Psr7\str;

class JadwalKelasController extends Controller
{
    /**
     * JadwalKelasController constructor.
     */
    public function __construct()
    {
        $this->middleware(['permission:Jadwal Kelas']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('ManajemenAssessmen.JadwalKelasController.index');
    }

    public function getJadwalKelasData(DataTables $dataTables)
    {
        $jadwalKelas = JadwalKelas::all();
        $jadwalKelas->load('program', 'tuk');

        $jadwalKelasJson = $dataTables->of($jadwalKelas)->addColumn('action', function (JadwalKelas $jadwalKelas) {
            $action = "<a href='" . route('jadwal-kelas.show', ['jadwal_kela' => $jadwalKelas]) . "' class='btn btn-sm btn-icon btn-clean btn-icon-sm modalIframe' data-toggle='kt-tooltip' title='View " . $jadwalKelas->program->name . "' data-original-tooltip='View " . $jadwalKelas->program->name . "'>
                              <i class='la la-search'></i>
                            </a>";
            if (auth()->user()->can('Jadwal Kelas Edit')) {
                $action .= "<a href='" . route('jadwal-kelas.edit', ['jadwal_kela' => $jadwalKelas]) . "' class='btn btn-sm btn-icon btn-clean btn-icon-sm' data-toggle='kt-tooltip' title='Edit' data-original-tooltip='Edit'>
                              <i class='la la-edit'></i>
                            </a>";
            }
            if (auth()->user()->can('Jadwal Kelas Delete')) {
                $action .= "<a href='" . route('jadwal-kelas.delete', ['jadwal_kela' => $jadwalKelas]) . "' class='btn btn-sm btn-icon btn-clean btn-icon-sm delconfirm' data-toggle='kt-tooltip' title='Hapus' data-original-tooltip='Hapus'>
                              <i class='la la-trash'></i>
                            </a>";
            }

            return $action;
        })->escapeColumns([])->make(true);

        return $jadwalKelasJson;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->can('Jadwal Kelas Add')) {
            $jadwalKelas = null;
            $programs    = Program::selectRaw("CONCAT(name,'( ',code,' ) ',' ') AS name, id")->active()->get()->pluck('name', 'id')->prepend('', '');
            $tuk         = TUK::active()->get()->pluck('name', 'id')->prepend('', '');
            return view('ManajemenAssessmen.JadwalKelasController.create', compact('jadwalKelas', 'programs', 'tuk'));
        } else {
            flash()->error("Maaf, Anda tidak mempunyai akses untuk menambah Jadwal Kelas");
            return redirect()->route('jadwal-kelas.index');
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
        if (auth()->user()->can('Jadwal Kelas Add')) {
            $request->validate([
                                   'program_id'          => 'required',
                                   'competence_place_id' => 'required',
                                   'price'               => 'required',
                                   'min_participants'    => 'required',
                                   'max_participants'    => 'required',
                                   'started_at'          => 'required',
                               ]);

            $jadwalKelas                    = new JadwalKelas($request->all());
            $token                          = \Str::random(16);
            $jadwalKelas->token             = $token;
            $jadwalKelas->training_duration = 1;

            if ($jadwalKelas->save()) {
                flash()->success('Berhasil menambahkan Jadwal Kelas');
            } else {
                flash()->error('Gagal menambahkan Jadwal Kelas');
            }
        } else {
            flash()->error('Maaf, Anda tidak mempunyai akses untuk menambah Jadwal Kelas');
        }
        return redirect()->route('jadwal-kelas.index');
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
     * @param JadwalKelas $jadwalKelas
     * @return void
     */
    public function edit(Request $request, $id)
    {
        if (auth()->user()->can('Jadwal Kelas Edit')) {
            $jadwalKelas = JadwalKelas::find($id);
            $programs    = Program::selectRaw("CONCAT(name,'( ',code,' ) ',' ') AS name, id")->active()->get()->pluck('name', 'id')->prepend('', '');
            $tuk         = TUK::active()->get()->pluck('name', 'id')->prepend('', '');
            return view('ManajemenAssessmen.JadwalKelasController.edit', compact('jadwalKelas', 'programs', 'tuk'));
        } else {
            flash()->error("Maaf, Anda tidak mempunyai akses untuk mengubah Jadwal Kelas");
            return redirect()->route('jadwal-kelas.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (auth()->user()->can('Jadwal Kelas Edit')) {
            $request->validate([
                                   'program_id'          => 'required',
                                   'competence_place_id' => 'required',
                                   'price'               => 'required',
                                   'min_participants'    => 'required',
                                   'max_participants'    => 'required',
                                   'started_at'          => 'required',
                               ]);

            /** @var  $update | get semua value POST dari form edit */
            $update = $request->all();

            /** Cek nilai untuk kolom field dan is_hidden , karena jika di uncentang maka value tidak ada di data yang di lempar di $request */
            $status              = $request->get('status');
            $update['status']    = empty($status) ? '0' : $status;
            $is_hidden           = $request->get('is_hidden');
            $update['is_hidden'] = empty($is_hidden) ? '0' : $is_hidden;

            $jadwalKelas         = JadwalKelas::find($id);

            if ($jadwalKelas->update($update)) {
                flash()->success('Berhasil mengubah data Jadwal Kelas');
            } else {
                flash()->success('Gagal mengubah data Jadwal Kelas');
            }
        } else {
            flash()->error("Maaf, Anda tidak mempunyai akses untuk mengubah Jadwal Kelas");
        }
        return redirect()->route('jadwal-kelas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        if (auth()->user()->can('Jadwal Kelas Delete')) {
            $jadwalKelas = JadwalKelas::find($id);
            if ($jadwalKelas->delete()) {
                flash()->success('Berhasil mneghapus data Jadwal Kelas');
            } else {
                flash()->error('Gagal Menghapus data Jadwal Kelas');
            }
        } else {
            flash()->error('Maaf, Anda tidak mempunyai kases untuk menghapus data jadwal kelas');
        }
        return redirect()->route('jadwal-kelas.index');
    }
}
