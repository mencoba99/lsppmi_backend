<?php

namespace App\Http\Controllers\ManajemenAssessmen;

use App\Http\Controllers\Controller;
use App\Models\Assessor;
use App\Models\JadwalKelas;
use App\Models\Ujian\Parameter;
use App\Models\Program;
use App\Models\MgtProgram;
use App\Models\CompetenceUnit;
use App\Models\Batch_modul_dtl;
use App\Models\ProgramSchedule;
use App\Models\TUK;
use App\Models\MemberCertification;
use App\Models\MemberCertificationAPL01;
use App\Models\MemberCertificationAPL02;
use App\Models\MemberCertificationPayment;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Yajra\DataTables\DataTables;
use DB;
use function GuzzleHttp\Psr7\str;

class JadwalKelasController extends Controller
{
    /**
     * JadwalKelasController constructor.
     */
    public function __construct()
    {
        //$this->middleware(['permission:Jadwal Kelas']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
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
                $action .= "<a href='" . route('jadwal-kelas.delete', ['jadwal_kelas' => $jadwalKelas]) . "' class='btn btn-sm btn-icon btn-clean btn-icon-sm delconfirm' data-toggle='kt-tooltip' title='Hapus' data-original-tooltip='Hapus'>
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


            $parameter         = Parameter::active()->get()->pluck('name', 'ujian_parameter_id')->prepend('', '');
            $assessor    = Assessor::active()->get()->pluck('name', 'id');
            // return $parameter ; exit;
            return view('ManajemenAssessmen.JadwalKelasController.create', compact('jadwalKelas', 'programs', 'tuk', 'assessor','parameter'));
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
            $cek = Program::find($jadwalKelas->program_id)->first();

            foreach($cek->type as $value){
                 if($value['type']=='direct'){
                    $jadwalKelas->is_ujian = true;
                 }
            }


            $token                          = \Str::random(16);
            $jadwalKelas->token             = $token;
            $jadwalKelas->aktif             = true;
            $jadwalKelas->training_duration = 1;

            /** Get Assessor */
            $assessor_ids = $request->get('assessor_id');
            $assessor_ids = Arr::flatten($assessor_ids);




            if ($jadwalKelas->save()) {
                /** Save to  */
                $last_batch_id = $jadwalKelas->id;
                $program_id = $request->program_id;
                $moduls   = MgtProgram::where('program_id', $program_id)->where('status', 1)->get();
                // $moduls     = DB::table('competence_units')->whereIn('id', $modul_id)->get();
                // @insert tbl:batch_modul_dtl
                foreach ($moduls as $modul) {
                    $Modul = CompetenceUnit::where('id', $modul->modul_id)->first();
                    $modul_dtl                             = new Batch_modul_dtl;
                    $modul_dtl->batch_id                   = $last_batch_id;
                    $modul_dtl->modul_id                   = $modul->modul_id;
                    $modul_dtl->nama_modul                 = $Modul->name;
                    $modul_dtl->persentase_kelulusan_modul = $modul->program->persentase_kelulusan;
                    $modul_dtl->save();
                }

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
        $classes = DB::table('program_schedules as ps')
        ->join('programs as p', 'ps.program_id', '=', 'p.id')
        ->join('competence_places as cp', 'ps.competence_place_id', '=', 'cp.id')
        ->where('p.code', $jadwalKelas->program->code)
        ->where('ps.is_publish', 1)
        ->where('ps.is_hidden', 0)
        ->where('ps.registration_closed', 0)
        ->select('ps.id as schedule_id', 'p.code', 'p.name', 'cp.name as place', 'ps.started_at')
        ->get();

        $jadwalKelas->classes = $classes;
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
            $parameter   = Parameter::active()->get()->pluck('name', 'ujian_parameter_id')->prepend('', '');
            return view('ManajemenAssessmen.JadwalKelasController.edit', compact('jadwalKelas', 'programs', 'tuk', 'assessor','parameter'));
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
        })->editColumn('registration_closed', function (ProgramSchedule $programSchedule) {
            $status = '';
            if ($programSchedule->registration_closed == 1) {
                $status = "<span class='kt-badge kt-badge--inline kt-badge--danger'>Pendaftaran Ditutup</span>";
            } else {
                $status = "<span class='kt-badge kt-badge--inline kt-badge--brand'>Pendaftaran Dibuka</span>";
            }
            return $status;
        })->addColumn('testing', function (ProgramSchedule $programSchedule) {
            return 'aaaa';
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

    /**
     * Halaman proses peutupan pendaftaran kelas
     *
     * @param Request $request
     * @param ProgramSchedule $programSchedule
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function registerView(Request $request, $id)
    {
        if (auth()->user()->can('Jadwal Kelas Close Register')) {
            $jadwalKelas = ProgramSchedule::find($id);
            return view('ManajemenAssessmen.JadwalKelasController.register-view', compact('jadwalKelas'));
        } else {
            flash()->error('Maaf, Anda tidak mempunyai akses untuk Publish Kelas');
            return redirect('/');
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @param $status
     * @return \Illuminate\Http\RedirectResponse
     */
    public function registerJadwalKelas(Request $request, $id, $status)
    {
        $jadwalKelas = ProgramSchedule::find($id);
        if (auth()->user()->can('Jadwal Kelas Close Register')) {
            if ($status == 'tutuppendaftaran') {
                $update = ['registration_closed' => 1, 'date_registration_closed' => date('Y-m-d H:i:s')];
                if ($jadwalKelas->update($update)) {
                    flash()->success('Berhasil Menutup Pendaftaran Jadwal Kelas');
                } else {
                    flash()->error('Gagal Menutup Pendaftaran Jadwal Kelas');
                }
            } elseif ($status == 'bukapendaftaran') {
                $update = ['registration_closed' => '0', 'date_registration_closed' => 'NULL'];
                if ($jadwalKelas->update($update)) {
                    flash()->success('Berhasil Membatalkan Penutupan Pendaftaran Jadwal Kelas');
                } else {
                    flash()->error('Gagal Membatalkan Penutupan Pendaftaran Jadwal Kelas');
                }
            }
        } else {
            flash()->error('Maaf, Anda tidak mempunyai akses untuk Menutup pendaftaran Jadwal Kelas');
        }
//        return redirect()->route('jadwal-kelas.register.view', ['jadwal_kelas' => $jadwalKelas]);
    }

    /**
     * @param DataTables $dataTables
     * @return mixed
     * @throws \Exception
     */
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
        })->editColumn('registration_closed', function (ProgramSchedule $programSchedule) {
            $status = '';
            if ($programSchedule->registration_closed == 1) {
                $status = "<span class='kt-badge kt-badge--inline kt-badge--danger'>Pendaftaran Ditutup</span>";
            } else {
                $status = "<span class='kt-badge kt-badge--inline kt-badge--brand'>Pendaftaran Dibuka</span>";
            }
            return $status;
        })->addColumn('jml_pendaftar', function (ProgramSchedule $programSchedule) {
            return $programSchedule->pendaftar()->count();
        })->escapeColumns([])->make(true);

        return $jadwalKelasJson;
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function transfer()
    {
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        DB::beginTransaction();

        try {
            $scheduleFrom = ProgramSchedule::findOrFail(request('program_schedule_id'));
            $scheduleTo = ProgramSchedule::findOrFail(request('program_schedule_id_to'));

            $certFrom = MemberCertification::findOrFail(request('member_certification_id'));
            $apl01From = MemberCertificationAPL01::where('member_certification_id', request('member_certification_id'))->get();
            $apl02From = MemberCertificationAPL02::where('member_certification_id', request('member_certification_id'))->get();

            // Update member_certification lama
            $certFrom->status = 5;
            $certFrom->save();

            // Insert member_certification baru
            $certNewData = [
                'member_id' => $certFrom->member_id,
                'program_schedule_id' => request('program_schedule_id_to'),
                'payment_method_id' => $certFrom->payment_method_id,
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'token' => substr(str_shuffle($permitted_chars), 0, 32),
                'is_paid' => $certFrom->is_paid
            ];

            //dd($certNewData);

            $certNew = MemberCertification::create($certNewData);


            // copy payment dari lama ke baru
            $paymentNewData = [
                'member_certification_id' => $certNew->id,
                'account_no' => $certFrom->payment->account_no,
                'account_name' => $certFrom->payment->account_name,
                'payment_file' => $certFrom->payment->payment_file,
                'transfer_date' => $certFrom->payment->transfer_date,
                'status' => $certFrom->payment->status,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            MemberCertificationPayment::create($paymentNewData);

            // Looping buat insert data APL01 lama ke yang baru
            foreach ($apl01From as $key => $value) {
                $apl01 = [
                    'member_certification_id' => $certNew->id,
                    'program_competence_unit_id' => $value->program_competence_unit_id,
                    'proof' => $value->proof,
                    'status' => $value->status,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];

                MemberCertificationAPL01::create($apl01);
            }

            // looping buat insert data APL02 lama ke yang baru
            foreach ($apl02From as $key => $value) {
                $apl02 = [
                    'member_certification_id' => $certNew->id,
                    'competence_kuk_id' => $value->competence_kuk_id,
                    'is_competent' => $value->is_competent,
                    'proof' => $value->proof,
                    'status' => $value->status,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];

                MemberCertificationAPL02::create($apl02);
            }

        } catch (\Exception $e) {
            Log::error($e);
            DB::rollBack();

            flash()->error('Terjadi kesalahan transfer kelas.');
            return redirect()->back();
        }

        DB::commit();

        flash()->success('Transfer kelas berhasil.');
        return redirect()->back();
    }

    /**
     * Halaman index untuk proses approval kelas
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function ujianIndex()
    {
        if (auth()->user()->can('Jadwal Kelas Open Ujian')) {
            return view('ManajemenAssessmen.JadwalKelasController.ujian-index');
        } else {
            flash()->error('Maaf, Anda tidak mempunyai akses untuk Buka Ujian Kelas');
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
    public function getJadwalKelasUjianData(DataTables $dataTables)
    {
        $jadwalKelas = ProgramSchedule::where('is_publish', 1)->where('status', 1)->where('registration_closed', 1)->where('aktif', true)->where('is_ujian', true)->orderBy('id', 'desc')->get();
        $jadwalKelas->load('program', 'tuk');

        $jadwalKelasJson = $dataTables->of($jadwalKelas)->addColumn('action', function (ProgramSchedule $jadwalKelas) {
            $action = "";
            if (auth()->user()->can('Jadwal Kelas Open Ujian')) {
                $action .= "<button data-id='".$jadwalKelas->id. "' class='btn btn-sm btn-icon btn-clean btn-icon-sm openUjian' data-toggle='kt-tooltip' title='Buka Ujian Kelas' data-original-tooltip='Buka Ujian Kelas'>
                              <i class='la la-check'></i>
                            </button>";
            }

            return $action;
        })->escapeColumns([])->make(true);

        return $jadwalKelasJson;
    }



    /**
     * Proses Approval & Batalkan Approve Jadwal Kelas
     *
     * @param Request $request
     * @param JadwalKelas $jadwalKelas
     * @param $status
     * @return \Illuminate\Http\RedirectResponse
     */

    public function ujianJadwalKelas(Request $request)
    {
        if (auth()->user()->can('Jadwal Kelas Open Ujian')) {
            if(ProgramSchedule::find($request->id)->update(['status' => 5])){
                return json_encode(array(
                    "status"=>200,
                    "message"=>"sukses"
                ));
            }
        }
    }

     /**
     * Proses Cek CBT Jadwal Kelas
     *
     * @param Request $request
     * @param Program $program
     * @param $status
     * @return \Illuminate\Http\RedirectResponse
     */

    public function getCBTTrue(Request $request)
    {
        $program = Program::find($request->id);
        foreach( $program->type as $value){
            return $value['type'];
        }

    }

}
