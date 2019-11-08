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
        })->editColumn('status', function (JadwalKelas $jadwalKelas) {
            $status = '';
            /** Status Aktif atau tidak */
            if ($jadwalKelas->status == 1) {
                $status .= '<button type="button" class="btn btn-brand btn-elevate btn-circle btn-icon btn-sm" data-toggle="kt-tooltip" data-original-title="Aktif"><i class="la la-check"></i></button>';
            } elseif ($jadwalKelas->status == 0) {
                $status .= '<button type="button" class="btn btn-secondary btn-elevate btn-circle btn-icon btn-sm" data-toggle="kt-tooltip" data-original-title="Tidak Aktif"><i class="la la-check"></i></button>';
            } elseif ($jadwalKelas->status == 2) {
                $status .= '<button type="button" class="btn btn-warning btn-elevate btn-circle btn-icon btn-sm" data-toggle="kt-tooltip" data-original-title="Kelas dibatalkan"><i class="la la-check"></i></button>';
            } elseif ($jadwalKelas->status == 3) {
                $status .= '<button type="button" class="btn btn-danger btn-elevate btn-circle btn-icon btn-sm" data-toggle="kt-tooltip" data-original-title="Kelas ditutup"><i class="la la-check"></i></button>';
            }

            /** Status Approve atau Tidak */
            if ($jadwalKelas->is_approve == 1) {
                $status .= '<button type="button" class="btn btn-brand btn-elevate btn-circle btn-icon btn-sm" data-toggle="kt-tooltip" data-original-title="Sudah diapprove"><i class="flaticon-like"></i></button>';
            } else {
                $status .= '<button type="button" class="btn btn-secondary btn-elevate btn-circle btn-icon btn-sm" data-toggle="kt-tooltip" data-original-title="Belum diapprove"><i class="flaticon-like"></i></button>';
            }

            /** Status Hide atau tidak */
            if ($jadwalKelas->is_hidden == 1) {
                $status .= '<button type="button" class="btn btn-brand btn-elevate btn-circle btn-icon btn-sm" data-toggle="kt-tooltip" data-original-title="Ditampilkan"><i class="la la-eye"></i></button>';
            } else {
                $status .= '<button type="button" class="btn btn-secondary btn-elevate btn-circle btn-icon btn-sm" data-toggle="kt-tooltip" data-original-title="Tidak ditampilkan"><i class="la la-eye"></i></button>';
            }

            /** Status Publish atau tidak */
            if ($jadwalKelas->is_publish == 1) {
                $status .= '<button type="button" class="btn btn-brand btn-elevate btn-circle btn-icon btn-sm" data-toggle="kt-tooltip" data-original-title="Sudah dipublish"><i class="la la-flag-checkered"></i></button>';
            } else {
                $status .= '<button type="button" class="btn btn-secondary btn-elevate btn-circle btn-icon btn-sm" data-toggle="kt-tooltip" data-original-title="Belum dipublish"><i class="la la-flag-checkered"></i></button>';
            }

            return $status;
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

    /**
     * Halaman index untuk proses approval kelas
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function approveIndex()
    {
        if (auth()->user()->can('Jadwal Kelas Approve')) {
            return view('ManajemenAssessmen.JadwalKelasController.approve-index');
        } else {
            flash()->error('Maaf, Anda tidak mempunyai akses untuk Approval Kelas');
            return redirect('/');
        }
    }

    /**
     * Method untuk get Data kelas yang belum approve untuk feed datatable halaman approve
     *
     * @param DataTables $dataTables
     * @return mixed
     * @throws \Exception
     */
    public function getJadwalKelasNotApproveData(DataTables $dataTables)
    {
        $jadwalKelas = JadwalKelas::where('is_approve',0)->where('status',1)->get();
        $jadwalKelas->load('program', 'tuk');

        $jadwalKelasJson = $dataTables->of($jadwalKelas)->addColumn('action', function (JadwalKelas $jadwalKelas) {
            $action = "<a href='" . route('jadwal-kelas.show', ['jadwal_kela' => $jadwalKelas]) . "' class='btn btn-sm btn-icon btn-clean btn-icon-sm modalIframe' data-toggle='kt-tooltip' title='View " . $jadwalKelas->program->name . "' data-original-tooltip='View " . $jadwalKelas->program->name . "'>
                              <i class='la la-search'></i>
                            </a>";
            if (auth()->user()->can('Jadwal Kelas Approve')) {
                $action .= "<a href='" . route('jadwal-kelas.approve.view', ['jadwal_kelas' => $jadwalKelas]) . "' class='btn btn-sm btn-icon btn-clean btn-icon-sm modalIframe' data-toggle='kt-tooltip' title='Approve Kelas' data-original-tooltip='Approve Kelas'>
                              <i class='la la-check'></i>
                            </a>";
            }

            return $action;
        })->escapeColumns([])->make(true);

        return $jadwalKelasJson;
    }

    /**
     * Halaman pop up untuk proses Approval/Unapprove Kelas
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function approveView(Request $request, $id)
    {
        if (auth()->user()->can('Jadwal Kelas Approve')) {
            $jadwalKelas = JadwalKelas::find($id);
            return view('ManajemenAssessmen.JadwalKelasController.approve-view', compact('jadwalKelas'));
        } else {
            flash()->error('Maaf, Anda tidak mempunyai akses untuk Approval Kelas');
            return redirect('/');
        }
    }

    /**
     * Proses Approval & Batalkan Approve Jadwal Kelas
     *
     * @param Request $request
     * @param JadwalKelas $jadwalKelas
     * @param $status
     * @return \Illuminate\Http\RedirectResponse
     */
    public function approveJadwalKelas(Request $request, JadwalKelas $jadwalKelas, $status)
    {
        if (auth()->user()->can('Jadwal Kelas Approve')) {
            if ($status == 'approve') {
                $update = ['is_approve'=>1,'approve_by'=>auth()->user()->id,'date_approve'=>date('Y-m-d H:i:s')];
                if ($jadwalKelas->update($update)) {
                    flash()->success('Berhasil Approve Jadwal Kelas');
                } else {
                    flash()->error('Gagal Approve Jadwal Kelas');
                }
            } elseif ($status == 'unapprove') {
                $update = ['is_approve'=>'0','approve_by'=>'NULL','date_approve'=>'NULL'];
                if ($jadwalKelas->update($update)) {
                    flash()->success('Berhasil Approve Jadwal Kelas');
                } else {
                    flash()->error('Gagal Approve Jadwal Kelas');
                }
            }
        } else {
            flash()->error('Maaf, Anda tidak mempunyai akses untuk Approval Kelas');
        }
        return redirect()->route('jadwal-kelas.approve.view',['jadwal_kelas'=>$jadwalKelas]);
    }
}
