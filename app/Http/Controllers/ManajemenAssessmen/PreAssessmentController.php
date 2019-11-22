<?php

namespace App\Http\Controllers\ManajemenAssessmen;

use App\Http\Controllers\Controller;
use App\Models\JadwalKelas;
use App\Models\MemberCertification;
use App\Models\MemberCertificationAPL02;
use App\Models\MemberCertificationChat;
use App\Models\ProgramSchedule;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PreAssessmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('ManajemenAssessmen.PreAssessmentController.index');
    }

    public function getPreAssessmentData(DataTables $dataTables)
    {
        $jadwalKelas = ProgramSchedule::where('is_publish', 1)->where('status', 1)->get();
        $jadwalKelas->load('program', 'tuk');

        $jadwalKelasJson = $dataTables->of($jadwalKelas)->addColumn('action', function (ProgramSchedule $jadwalKelas) {
            $action = "<a href='" . route('jadwal-kelas.show', ['jadwal_kela' => $jadwalKelas]) . "' class='btn btn-sm btn-icon btn-clean btn-icon-sm modalIframe' data-toggle='kt-tooltip' title='View " . $jadwalKelas->program->name . "' data-original-tooltip='View " . $jadwalKelas->program->name . "'>
                              <i class='la la-search'></i>
                            </a>";
            if (auth()->user()->can('Jadwal Kelas Edit')) {
                $action .= "<a href='" . route('pre-assessment.viewallpeserta', ['jadwal_kelas' => $jadwalKelas]) . "' class='btn btn-sm btn-icon btn-clean btn-icon-sm' data-toggle='kt-tooltip' title='Data Peserta Assesmen' data-original-tooltip='Data Peserta Assesmen'>
                              <i class='la la-users'></i>
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
        })->escapeColumns([])->make(true);

        return $jadwalKelasJson;
    }

    public function viewAllPeserta(ProgramSchedule $jadwalKelas)
    {
//        return $jadwalKelas;
        return view('ManajemenAssessmen.PreAssessmentController.view-peserta', compact('jadwalKelas'));
    }

    public function viewSinglePeserta(MemberCertification $memberCertification)
    {
        $chatApl02 = MemberCertificationChat::apl02Chat($memberCertification->id)->get();
        return view('ManajemenAssessmen.PreAssessmentController.view-single-peserta', compact('memberCertification', 'chatApl02'));
    }

    public function saveChatApl02(Request $request, MemberCertification $memberCertification)
    {
        $message = $request->get('message');

        $chat = new MemberCertificationChat();

        $chat->member_certification_id = $memberCertification->id;
        $chat->user_id                 = auth()->user()->id;
        $chat->message                 = $message;
        $chat->chat_type               = 2;

        $result = ['status'=>false,'data'=>null];

        if ($chat->save()) {
            $chat->load('asesor');
            $result['status'] = true;
            $result['data'] = $chat;
        }

        echo json_encode($result);
    }

    /**
     * Proses untuk mengubah status APL-02 Jenis status = [approve,unapprove,reject]
     *
     * @param Request $request
     * @param MemberCertification $memberCertification
     * @return void
     */
    public function approveAPL02(Request $request, MemberCertification $memberCertification, $status)
    {
        $apl02 = $memberCertification->apl02();

        if ($status == 'approve') {
            if ($apl02->update(['status'=>1])) {
                flash()->success('Berhasil Approve APL-02');
            } else {
                flash()->error('Gagal Approve APL-02');
            }
        } elseif ($status == 'unapprove') {
            if ($apl02->update(['status'=>'0'])) {
                flash()->success('Berhasil Unapprove APL-02');
            } else {
                flash()->error('Gagal Unapprove APL-02');
            }
        } elseif ($status == 'reject') {
            if ($apl02->update(['status'=>2])) {
                flash()->success('Berhasil Reject APL-02');
            } else {
                flash()->error('Gagal Reject APL-02');
            }
        }

        return redirect()->route('pre-assessment.viewsinglepeserta',['member_certification'=>$memberCertification]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
