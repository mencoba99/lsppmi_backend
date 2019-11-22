<?php

namespace App\Http\Controllers\ManajemenAssessmen;

use App\Http\Controllers\Controller;
use App\Models\Assessor;
use App\Models\JadwalKelas;
use App\Models\Program;
use App\Models\ProgramSchedule;
use App\Models\TUK;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
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
        $jadwalKelas = ProgramSchedule::orderBy('id','desc')->get();
        $jadwalKelas->load('program', 'tuk');

        $jadwalKelasJson = $dataTables->of($jadwalKelas)->addColumn('action', function (ProgramSchedule $jadwalKelas) {
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
        })->editColumn('status', function (ProgramSchedule $jadwalKelas) {
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
        })->addColumn('pendaftar', function (ProgramSchedule $jadwalKelas) {
            $pendaftar = $jadwalKelas->pendaftar->count();
//            $pendaftar = 0;
            return $pendaftar;
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
            $assessor    = Assessor::active()->get()->pluck('name', 'id');

            return view('ManajemenAssessmen.JadwalKelasController.create', compact('jadwalKelas', 'programs', 'tuk', 'assessor'));
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
                                   'assessor_id'         => 'required',
                               ]);

            $jadwalKelas                    = new ProgramSchedule($request->all());
            $token                          = \Str::random(16);
            $jadwalKelas->token             = $token;
            $jadwalKelas->training_duration = 1;

            /** Get Assessor */
            $assessor_ids = $request->get('assessor_id');
            $assessor_ids = Arr::flatten($assessor_ids);

            if ($jadwalKelas->save()) {
                /** Save Assessor */
                $jadwalKelas->assessor()->sync($assessor_ids);
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
    public function show(ProgramSchedule $jadwalKelas)
    {
        return view('ManajemenAssessmen.JadwalKelasController.show', compact('jadwalKelas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param JadwalKelas $jadwalKelas
     * @return void
     */
    public function edit(Request $request, ProgramSchedule $jadwalKelas)
    {
        if (auth()->user()->can('Jadwal Kelas Edit')) {
//            $jadwalKelas = ProgramSchedule::find($id);
            $programs    = Program::selectRaw("CONCAT(name,'( ',code,' ) ',' ') AS name, id")->active()->get()->pluck('name', 'id')->prepend('', '');
            $tuk         = TUK::active()->get()->pluck('name', 'id')->prepend('', '');
            $assessor    = Assessor::active()->get()->pluck('name', 'id');
            return view('ManajemenAssessmen.JadwalKelasController.edit', compact('jadwalKelas', 'programs', 'tuk', 'assessor'));
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
    public function update(Request $request, ProgramSchedule $jadwalKelas)
    {
        if (auth()->user()->can('Jadwal Kelas Edit')) {
            $request->validate([
                                   'program_id'          => 'required',
                                   'competence_place_id' => 'required',
                                   'price'               => 'required',
                                   'min_participants'    => 'required',
                                   'max_participants'    => 'required',
                                   'started_at'          => 'required',
                                   'assessor_id'         => 'required|array',
                                   'assessor_id.*.*'       => 'required|distinct|min:1',
                               ]);
            /** @var  $update | get semua value POST dari form edit */
            $update = $request->all();

            /** Cek nilai untuk kolom field dan is_hidden , karena jika di uncentang maka value tidak ada di data yang di lempar di $request */
            $status              = $request->get('status');
            $update['status']    = empty($status) ? '0' : $status;
            $is_hidden           = $request->get('is_hidden');
            $update['is_hidden'] = empty($is_hidden) ? '0' : $is_hidden;

//            $jadwalKelas = ProgramSchedule::find($id);

            /** Get Assessor */
            $assessor_ids = $request->get('assessor_id');
            $assessor_ids = Arr::flatten($assessor_ids);

            if ($jadwalKelas->update($update)) {
                $jadwalKelas->assessor()->sync($assessor_ids);
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
            $jadwalKelas = ProgramSchedule::find($id);
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
        $jadwalKelas = ProgramSchedule::where('is_publish', 0)->where('status', 1)->orderBy('id', 'desc')->get();
        $jadwalKelas->load('program', 'tuk');

        $jadwalKelasJson = $dataTables->of($jadwalKelas)->addColumn('action', function (ProgramSchedule $jadwalKelas) {
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
            $jadwalKelas = ProgramSchedule::find($id);
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
    public function approveJadwalKelas(Request $request, ProgramSchedule $jadwalKelas, $status)
    {
        if (auth()->user()->can('Jadwal Kelas Approve')) {
            if ($status == 'approve') {
                $update = ['is_approve' => 1, 'approve_by' => auth()->user()->id, 'date_approve' => date('Y-m-d H:i:s')];
                if ($jadwalKelas->update($update)) {
                    flash()->success('Berhasil Approve Jadwal Kelas');
                } else {
                    flash()->error('Gagal Approve Jadwal Kelas');
                }
            } elseif ($status == 'unapprove') {
                $update = ['is_approve' => '0', 'approve_by' => 'NULL', 'date_approve' => 'NULL'];
                if ($jadwalKelas->update($update)) {
                    flash()->success('Berhasil Approve Jadwal Kelas');
                } else {
                    flash()->error('Gagal Approve Jadwal Kelas');
                }
            }
        } else {
            flash()->error('Maaf, Anda tidak mempunyai akses untuk Approval Kelas');
        }
        return redirect()->route('jadwal-kelas.approve.view', ['jadwal_kelas' => $jadwalKelas]);
    }

    /**
     * Untuk modul Publish/Unpublish Jadwal kelas
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function publishIndex()
    {
        if (auth()->user()->can('Jadwal Kelas Publish')) {
            return view('ManajemenAssessmen.JadwalKelasController.publish-index');
        } else {
            flash()->error('Maaf, Anda tidak mempunyai akses untuk Publish Kelas');
            return redirect('/');
        }
    }

    /**
     * Untuk feed datatable pada Modul Publish/Unpublish Jadwal Kelas
     *
     * @param DataTables $dataTables
     * @return mixed
     * @throws \Exception
     */
    public function getJadwalKelasNotPublishData(DataTables $dataTables)
    {
        $jadwalKelas = ProgramSchedule::where('is_approve', 1)->where('status', 1)->where('registration_closed', 0)->orderBy('id', 'desc')->get();
        $jadwalKelas->load('program', 'tuk');

        $jadwalKelasJson = $dataTables->of($jadwalKelas)->addColumn('action', function (ProgramSchedule $jadwalKelas) {
            $action = "<a href='" . route('jadwal-kelas.show', ['jadwal_kela' => $jadwalKelas]) . "' class='btn btn-sm btn-icon btn-clean btn-icon-sm modalIframe' data-toggle='kt-tooltip' title='View " . $jadwalKelas->program->name . "' data-original-tooltip='View " . $jadwalKelas->program->name . "'>
                              <i class='la la-search'></i>
                            </a>";
            if (auth()->user()->can('Jadwal Kelas Approve')) {
                $action .= "<a href='" . route('jadwal-kelas.publish.view', ['jadwal_kelas' => $jadwalKelas]) . "' class='btn btn-sm btn-icon btn-clean btn-icon-sm modalIframe' data-toggle='kt-tooltip' title='Publish Kelas' data-original-tooltip='Publish Kelas'>
                              <i class='la la-check'></i>
                            </a>";
            }

            return $action;
        })->escapeColumns([])->make(true);

        return $jadwalKelasJson;
    }

    /**
     * Untuk Modal pop up pada Modul Publish/Unpublish Jadwal Kelas
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function publishView(Request $request, $id)
    {
        if (auth()->user()->can('Jadwal Kelas Publish')) {
            $jadwalKelas = ProgramSchedule::find($id);
            return view('ManajemenAssessmen.JadwalKelasController.publish-view', compact('jadwalKelas'));
        } else {
            flash()->error('Maaf, Anda tidak mempunyai akses untuk Publish Kelas');
            return redirect('/');
        }
    }

    /**
     * Proses Publish/Unpublish Jadwal Kelas
     *
     * @param Request $request
     * @param JadwalKelas $jadwalKelas
     * @param $status
     * @return \Illuminate\Http\RedirectResponse
     */
    public function publishJadwalKelas(Request $request, ProgramSchedule $jadwalKelas, $status)
    {
        if (auth()->user()->can('Jadwal Kelas Publish')) {
            if ($status == 'publish') {
                $update = ['is_publish' => 1, 'date_publish' => date('Y-m-d H:i:s')];
                if ($jadwalKelas->update($update)) {
                    flash()->success('Berhasil Publish Jadwal Kelas');
                } else {
                    flash()->error('Gagal Publish Jadwal Kelas');
                }
            } elseif ($status == 'unpublish') {
                $update = ['is_publish' => '0', 'date_publish' => 'NULL'];
                if ($jadwalKelas->update($update)) {
                    flash()->success('Berhasil Publish Jadwal Kelas');
                } else {
                    flash()->error('Gagal Publish Jadwal Kelas');
                }
            }
        } else {
            flash()->error('Maaf, Anda tidak mempunyai akses untuk Publish Kelas');
        }
        return redirect()->route('jadwal-kelas.publish.view', ['jadwal_kelas' => $jadwalKelas]);
    }

    public function registerIndex()
    {
        if (auth()->user()->can('Jadwal Kelas Close Register')) {
            return view('ManajemenAssessmen.JadwalKelasController.register-index');
        } else {
            flash()->error('Maaf, Anda tidak mempunyai akses untuk Penutupan Pendaftaran Kelas');
            return redirect('/');
        }
    }

    public function getJadwalKelasNotCloseRegisterData(DataTables $dataTables)
    {
        $jadwalKelas = ProgramSchedule::where('is_approve', 1)->where('status', 1)->where('is_publish', 1)->orderBy('id', 'desc')->get();
        $jadwalKelas->load('program', 'tuk');

        $jadwalKelasJson = $dataTables->of($jadwalKelas)->addColumn('action', function (ProgramSchedule $jadwalKelas) {
            $action = "<a href='" . route('jadwal-kelas.show', ['jadwal_kela' => $jadwalKelas]) . "' class='btn btn-sm btn-icon btn-clean btn-icon-sm modalIframe' data-toggle='kt-tooltip' title='View " . $jadwalKelas->program->name . "' data-original-tooltip='View " . $jadwalKelas->program->name . "'>
                              <i class='la la-search'></i>
                            </a>";
            if (auth()->user()->can('Jadwal Kelas Close Register')) {
                $action .= "<a href='" . route('jadwal-kelas.register.view', ['jadwal_kelas' => $jadwalKelas]) . "' class='btn btn-sm btn-icon btn-clean btn-icon-sm modalIframe' data-toggle='kt-tooltip' title='Tutup Pendaftaran Kelas' data-original-tooltip='Tutup Pendaftaran Kelas'>
                              <i class='la la-check'></i>
                            </a>";
            }

            return $action;
        })->escapeColumns([])->make(true);

        return $jadwalKelasJson;
    }
}
