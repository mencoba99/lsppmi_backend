<?php

namespace App\Http\Controllers\ManajemenAssessmen;

use App\Http\Controllers\Controller;
use App\Models\JadwalKelas;
use App\Models\MemberCertification;
use App\Models\MemberCertificationAPL02;
use App\Models\MemberCertificationChat;
use App\Models\MemberCertificationPaap;
use App\Models\Pendaftaran_trx;
use App\Models\ProgramSchedule;
use Arr;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PreAssessmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
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
            if (auth()->user()->can('Validasi APL-02')) {
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
        $paap = $memberCertification->paap;

//        return count($memberCertification->schedules->program->type);
        $direct = \Arr::where($memberCertification->schedules->program->type, function ($value, $key) {
//            return $value;
            return ($value['type'] == 'direct');
        });
//        return $direct['type'];
        $direct = Arr::get($direct, '0.methods');

        $indirect = \Arr::where($memberCertification->schedules->program->type, function ($value, $key) {
            if (!empty($value['type'])) {
                return ($value['type'] == 'indirect');
            } else return null;
        });
        $indirect = !empty($indirect) ? Arr::get($indirect, '1.methods'):[];

        return view('ManajemenAssessmen.PreAssessmentController.view-single-peserta', compact('memberCertification', 'chatApl02', 'direct', 'indirect', 'paap'));
    }

    public function saveChatApl02(Request $request, MemberCertification $memberCertification)
    {
        $message = $request->get('message');

        $chat = new MemberCertificationChat();

        $chat->member_certification_id = $memberCertification->id;
        $chat->user_id                 = auth()->user()->id;
        $chat->message                 = $message;
        $chat->chat_type               = 2;

        $result = ['status' => false, 'data' => null];

        if ($chat->save()) {
            $chat->load('asesor');
            $result['status'] = true;
            $result['data']   = $chat;
        }

        echo json_encode($result);
    }

    /**
     * Proses untuk mengubah status APL-02 Jenis status = [approve,unapprove,reject]
     *
     * @param Request $request
     * @param MemberCertification $memberCertification
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function approveAPL02(Request $request, MemberCertification $memberCertification, $status)
    {
        \DB::beginTransaction();
        try {
            $apl02 = $memberCertification->apl02();

            if ($status == 'approve') {
                if ($apl02->update(['status' => 3])) {
                    /**
                     * Insert data peserta ke table pendaftaran_trx
                     */
                    $cek = Pendaftaran_trx::wherePendaftaranId($memberCertification->id)->where('batch_id', $memberCertification->program_schedule_id)->get();
                    if ($cek && $cek->count() == 0) {
                        $pendaftaran_trx = new Pendaftaran_trx();

                        $pendaftaran_trx->pendaftaran_id    = $memberCertification->id;
                        $pendaftaran_trx->batch_id          = $memberCertification->program_schedule_id;
                        $pendaftaran_trx->nama_batch        = $memberCertification->schedules->program->name;
                        $pendaftaran_trx->peserta_id        = $memberCertification->member_id;
                        $pendaftaran_trx->nama_peserta      = $memberCertification->members->name;
                        $pendaftaran_trx->tgl_daftar        = $memberCertification->created_at;
                        $pendaftaran_trx->harga_pendaftaran = $memberCertification->schedules->price;

                        $pendaftaran_trx->save();
                    }

                    /**
                     * Udate table member certification set status = 3
                     */
                    $memberCertification->update(['status' => 3]);

                    flash()->success('Berhasil Approve APL-02');
                } else {
                    flash()->error('Gagal Approve APL-02');
                }
            } elseif ($status == 'unapprove') {
                if ($apl02->update(['status' => 2])) {
                    $pendaftaran_trx = Pendaftaran_trx::wherePendaftaranId($memberCertification->id)->where('batch_id', $memberCertification->program_schedule_id);
                    $pendaftaran_trx->delete();

                    /**
                     * Udate table member certification set status = 2
                     */
                    $memberCertification->update(['status' => 2]);

                    flash()->success('Berhasil Unapprove APL-02');
                } else {
                    flash()->error('Gagal Unapprove APL-02');
                }
            } elseif ($status == 'reject') {
                if ($apl02->update(['status' => 4])) {
                    $pendaftaran_trx = Pendaftaran_trx::wherePendaftaranId($memberCertification->id)->where('batch_id', $memberCertification->program_schedule_id);
                    $pendaftaran_trx->delete();

                    /**
                     * Udate table member certification set status = 2
                     */
                    $memberCertification->update(['status' => 4]);

                    flash()->success('Berhasil Reject APL-02');
                } else {
                    flash()->error('Gagal Reject APL-02');
                }
            }
            \DB::commit();
        } catch (\Exception $exception) {
            \DB::rollBack();
        }

        return redirect()->route('pre-assessment.viewsinglepeserta', ['member_certification' => $memberCertification]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param MemberCertification $memberCertification
     * @return \Illuminate\Http\Response
     */
    public function savePaap(Request $request, MemberCertification $memberCertification)
    {
        $result = [
            'status' => false,
            'message' => 'Gagal menyimpan data PAAP'
        ];
        if (auth()->user()->can('Validasi APL-02')) {
            /**
             * Cek apakah Paap Sudah ada atau belum
             */
            if (is_object($memberCertification->paap) && $memberCertification->paap()->count() > 0) {
                $update = [
                    'pa_asesi'          => $request->get('pa_asesi'),
                    'pa_tujuan_asesmen' => $request->get('pa_tujuan_asesmen'),
                    'pa_konteks_asesmen' => $request->get('pa_konteks_asesmen'),
                    'pa_orang_relevan' => $request->get('pa_orang_relevan'),
                    'pa_tolak_ukur' => $request->get('pa_tolak_ukur'),
                    'metode_asesmen' => $request->get('metode_asesmen'),
                    'mk_1' => $request->get('mk_1'),
                    'mk_2' => $request->get('mk_2'),
                    'mk_3' => $request->get('mk_3'),
                    'mk_4' => $request->get('mk_4'),
                ];

                if ($memberCertification->paap()->update($update)) {
                    flash()->success('Berhasil memperbarui form PAAP');
//                    $result['status'] = true;
//                    $result['message'] = "Berhasil memperbarui form PAAP";
                } else {
                    flash()->error('Gagal memperbarui form PAAP');
//                    $result['message'] = "Berhasil memperbarui form PAAP";
                }
            } else {
                $paap = new MemberCertificationPaap();

                $paap->member_certification_id = $memberCertification->id;
                $paap->member_id               = $memberCertification->member_id;
                $paap->pa_asesi                = $request->get('pa_asesi');
                $paap->pa_tujuan_asesmen       = $request->get('pa_tujuan_asesmen');
                $paap->pa_konteks_asesmen      = $request->get('pa_konteks_asesmen');
                $paap->pa_orang_relevan        = $request->get('pa_orang_relevan');
                $paap->pa_tolak_ukur           = $request->get('pa_tolak_ukur');
                $paap->metode_asesmen          = $request->get('metode_asesmen');
                $paap->mk_1                    = $request->get('mk_1');
                $paap->mk_2                    = $request->get('mk_2');
                $paap->mk_3                    = $request->get('mk_3');
                $paap->mk_4                    = $request->get('mk_4');
                $paap->asesor_id               = auth()->user()->id;

                if ($paap->save()) {
                    flash()->success('Berhasil simpan form PAAP');
                } else {
                    flash()->error('Gagal simpan form PAAP');
                }
            }

        } else {
            flash()->error('Maaf Anda tidak mempunyai akses untuk Approval APL02');
        }
        return redirect()->route('pre-assessment.viewsinglepeserta', ['member_certification' => $memberCertification]);
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
