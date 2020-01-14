<?php

namespace App\Http\Controllers\ManajemenAssessmen;

use App\Http\Controllers\Controller;
use App\Models\Assessor;
use App\Models\DataMaster\Lisan;
use App\Models\DataMaster\Tertulis;
use App\Models\MemberCertification;
use App\Models\MemberCertificationInterview;
use App\Models\MemberCertificationRekaman;
use App\Models\ProgramSchedule;
use App\Models\StartUjian\Peserta_jawab;
use App\Models\StartUjian\Soal_peserta;
use App\Models\Ujian\Perdana_peserta;
use App\Models\Ujian\Ujian_batch;
use Arr;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AssessmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('ManajemenAssessmen.AssessmentController.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param DataTables $dataTables
     * @return void
     * @throws \Exception
     */
    public function getAssessmentData(DataTables $dataTables)
    {
        $jadwalKelas = ProgramSchedule::with(['tuk', 'program'])->where('is_publish', 1)->where('status', '>=', 1);
        $asesor      = Assessor::where('email', auth()->user()->email)->first();
        if (auth()->user()->hasRole('Assessor') && $asesor) {
            $jadwalKelas->whereHas('assessor', function (Builder $query) use ($asesor) {
                $query->where('assessor_id', $asesor->id);
            })->get();
        } else {
            $jadwalKelas->get();
        }

        $jadwalKelasJson = $dataTables->of($jadwalKelas)->addColumn('action', function (ProgramSchedule $jadwalKelas) {
            $action = "<a href='" . route('jadwal-kelas.show', ['jadwal_kela' => $jadwalKelas]) . "' class='btn btn-sm btn-icon btn-clean btn-icon-sm modalIframe' data-toggle='kt-tooltip' title='View " . $jadwalKelas->program->name . "' data-original-tooltip='View " . $jadwalKelas->program->name . "'>
                              <i class='la la-search'></i>
                            </a>";
            if (auth()->user()->hasRole('Assessor')) {
                $action .= "<a href='" . route('asesmen.viewallpeserta', ['jadwal_kelas' => $jadwalKelas]) . "' class='btn btn-sm btn-icon btn-clean btn-icon-sm' data-toggle='kt-tooltip' title='Data Peserta Assesmen' data-original-tooltip='Data Peserta Assesmen'>
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
        })->addColumn('jml_peserta', function (ProgramSchedule $programSchedule) {
            return $programSchedule->pendaftar->count();
        })->escapeColumns([])->make(true);

        return $jadwalKelasJson;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param ProgramSchedule $jadwalKelas
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function viewAllPeserta(Request $request, ProgramSchedule $jadwalKelas)
    {
        $asesor = null;
        if (auth()->user()->hasRole('Assessor')) {
            $asesor = Assessor::where('email', auth()->user()->email)->first();
        }

        return view('ManajemenAssessmen.AssessmentController.view-peserta', compact('jadwalKelas', 'asesor'));
    }

    /**
     * Display the specified resource.
     *
     * @param MemberCertification $memberCertification
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function viewSinglePeserta(MemberCertification $memberCertification)
    {
        $paap   = $memberCertification->paap;
        $direct = \Arr::where($memberCertification->schedules->program->type, function ($value, $key) {
            return ($value['type'] == 'direct');
        });
        $direct = Arr::get($direct, '0.methods');

        $indirect = \Arr::where($memberCertification->schedules->program->type, function ($value, $key) {
            return ($value['type'] == 'indirect');
        });
        $indirect = Arr::get($indirect, '1.methods');

        /**
         * Get Data Hasil Ujian CBT
         */
        $peserta_id = $memberCertification->id;
        $batch_id   = $memberCertification->schedules->id;

        $ujian_detail = \DB::table('ujian_detail')
                           ->whereIn('ujian_id', function ($q) use ($peserta_id, $batch_id) {
                               $q->select('ujian_id')
                                 ->from('ujian')
                                 ->where('peserta_id', $peserta_id)
                                 ->where('program_id', $batch_id);
                           })
                           ->whereNotNull('perdana_jadwal_id')
                           ->get();

//        return $ujian_detail;

        $ujian_batch_id = Ujian_batch::where('program_schedule_id', $batch_id)->pluck('ujian_batch_id');
//		return $ujian_batch_id;
        $ujian_batch_id  = [$ujian_batch_id->max()];
        $perdana_peserta = Perdana_peserta::where('peserta_id', $peserta_id)
                                          ->whereIn('ujian_batch_id', $ujian_batch_id)
                                          ->first();

        $perdana_peserta_id = Perdana_peserta::where('peserta_id', $peserta_id)->whereIn('ujian_batch_id', $ujian_batch_id)->pluck('perdana_peserta_id');
//        return $perdana_peserta_id;
        $soal_peserta_id = Soal_peserta::whereIn('perdana_peserta_id', $perdana_peserta_id)->get();
//        return $soal_peserta_id->pluck('soal_peserta_id');

        $total_soal = Peserta_jawab::whereIn('soal_peserta_id', $soal_peserta_id->pluck('soal_peserta_id'))->get();

        /**
         * Untuk Interview & Wawancara
         */
        $pertanyaan_lisan    = Lisan::where('status', 1)->get();
        $pertanyaan_tertulis = Tertulis::where('status', 1)->get();

        /**
         * Untuk Rekaman
         */
        $rekaman = MemberCertificationRekaman::where('member_certification_id', $memberCertification->id)->first();

        return view('ManajemenAssessmen.AssessmentController.view-single-peserta', compact('memberCertification', 'direct', 'indirect', 'paap', 'ujian_detail', 'total_soal'
            , 'pertanyaan_lisan', 'pertanyaan_tertulis', 'ujian_batch_id', 'perdana_peserta_id', 'soal_peserta_id', 'rekaman'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function getPertanyaanData(Request $request)
    {
        $id_pertanyaan           = $request->get('id_pertanyaan');
        $tipe_pertanyaan         = $request->get('tipe_pertanyaan');
        $member_certification_id = $request->get('member_certification_id');
        $member_id               = $request->get('member_id');

        $result = ['status' => false, 'message' => null, 'data' => ''];

        $memberCertification = MemberCertification::find($member_certification_id);
        /** Cek apakah MemberCertification ada atau tidak */
        if ($memberCertification && $memberCertification->count() > 0) {
            if ($tipe_pertanyaan == 'lisan') {
                $pertanyaan = Lisan::find($id_pertanyaan);
                if ($pertanyaan && $pertanyaan->count() > 0) {
                    /**
                     * Cek pertanyaan sudah ada atau belum
                     */
                    $cekPertanyaan   = MemberCertificationInterview::where('member_certification_id', $member_certification_id);
                    $totalPertanyaan = $cekPertanyaan->count() + 1;
                    $cekPertanyaan->where('pertanyaan_lisan_id', $id_pertanyaan)->first();
                    if ($cekPertanyaan && $cekPertanyaan->count() > 0) {
                        $result['status']  = false;
                        $result['message'] = 'Pertanyaan sudah dipilih sebelumnya';
                    } else {
                        $result['status']                   = true;
                        $result['message']                  = 'Sukses pertanyaan ditemukan';
                        $interview                          = new MemberCertificationInterview();
                        $interview->member_certification_id = $member_certification_id;
                        $interview->pertanyaan_lisan_id     = $id_pertanyaan;
                        $interview->urutan                  = $totalPertanyaan;
                        $interview->save();

                        $data           = "<tr>
                                <td>" . $totalPertanyaan . "</td>
                                <td>
                                    <table class='table table-bordered'>
                                        <tbody>
                                        <tr>
                                            <td>Pertanyaan : " . $pertanyaan->pertanyaan . "</td>
                                        </tr>
                                        <tr>
                                            <td>Jawaban yang diharapkan : " . $pertanyaan->jawaban . "</td>
                                        </tr>
                                        <tr>
                                            <td>Kesimpulan jawaban asesi : <textarea name='kesimpulan_" . $id_pertanyaan . "' id='' class='form-control' cols='30' rows='10'></textarea></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td><input type='radio' name='is_kompeten_" . $id_pertanyaan . "' value='kompeten'></td>
                                <td><input type='radio' name='is_kompeten_" . $id_pertanyaan . "' value='belum_kompeten'></td>
                                <td><a href='" . route('asesmen.interview.delete', ['interview_id' => $interview->id, 'member_certification' => $member_certification_id]) . "' class='btn btn-sm btn-icon btn-clean btn-icon-sm delconfirm' title='Delete Pertanyaan'><i class='la la-trash'></i></a></td>
                            </tr>";
                        $result['data'] = $data;
                    }

                } else {
                    $result['message'] = 'Pertanyaan tidak ditemukan';
                }
            } elseif ($tipe_pertanyaan == 'tertulis') {

            }
        } else {
            /** Jika MemberCertification tidak ditemukan */
            $result['message'] = 'Data pendaftaran tidak ditemukan';
        }

        echo json_encode($result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param $interview_id
     * @param MemberCertification $memberCertification
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destoryInterview(Request $request, $interview_id, MemberCertification $memberCertification)
    {
        $interview = MemberCertificationInterview::find($interview_id);
        if ($interview && $interview->count() > 0) {
            if ($interview->delete()) {
                flash()->success('Sukses, Data interview sukses dihapus');
            } else {
                flash()->error('Gagal, Data interview/wawancara gagal dihapus');
            }
        } else {
            flash()->error('Maaf Data interview/wawancara tidak ditemukan');
        }

        return redirect()->route('asesmen.viewsinglepeserta', ['member_certification' => $memberCertification]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param MemberCertification $memberCertification
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveInterview(Request $request, MemberCertification $memberCertification)
    {
//        return $request->all();

        $pertanyaan_id    = $request->get('pertanyaan_id');
        $kesimpulan       = $request->get('kesimpulan');
        $is_kompeten      = $request->get('is_kompeten');
        $tipe_pertanyaan  = $request->get('tipe_pertanyaan');
        $pertanyaan_field = 'pertanyaan_' . $tipe_pertanyaan . '_id';

        /**
         * Cek terlebih dahulu apakah pertanyaan sudah ada atau belum ditable member_certification_interview
         */
        if ($pertanyaan_id && count($pertanyaan_id) > 0) {
            $urutan = 1;
            foreach ($pertanyaan_id as $item) {
                $cek = MemberCertificationInterview::where('member_certification_id', $memberCertification->id)->where($pertanyaan_field, $item)->first();
                if ($cek && $cek->count() > 0) {
                    /** Update data jika data sudah ada */
                    $update = [
                        'kesimpulan'  => $kesimpulan[ $item ],
                        'is_kompeten' => $is_kompeten[ $item ],
                    ];
                    if ($cek->update($update)) {
                        flash()->success('Data Interview berhasil disimpan');
                    } else {
                        flash()->error('Data Interview gagal di perbarui');
                    }
                } else {
                    /** Insert data jika belum ada */
                    $interview = new MemberCertificationInterview();

                    $interview->member_certification_id = $memberCertification->id;
                    $interview->$pertanyaan_field       = $item;
                    $interview->kesimpulan              = $kesimpulan[ $item ];
                    $interview->is_kompeten             = $is_kompeten[ $item ];
                    $interview->urutan                  = $urutan;
                    $urutan++;

                    if ($interview->save()) {
                        flash()->success('Data Interview berhasil disimpan');
                    } else {
                        flash()->error('Data Interview gagal di masukkan');
                    }
                }
            }
        } else {
            flash()->error('Silahkan pilih pertanyaan terlebih dahulu');
        }

        return redirect()->route('asesmen.viewsinglepeserta', ['member_certification' => $memberCertification]);
    }

    public function saveRekaman(Request $request, MemberCertification $memberCertification)
    {
        /** Gathering Data */
        $tindak_lanjut        = $request->get('tindak_lanjut');
        $elemen_tindak_lanjut = $request->get('elemen_tindak_lanjut');
        $kuk_tindak_lanjut    = $request->get('kuk_tindak_lanjut');

        $komentar_asesor        = $request->get('komentar_asesor');
        $elemen_komentar_asesor = $request->get('elemen_komentar_asesor');
        $kuk_komentar_asesor    = $request->get('kuk_komentar_asesor');

        $arrTindakLanjut   = ['tindak_lanjut' => $tindak_lanjut, 'elemen' => $elemen_tindak_lanjut, 'kuk' => $kuk_tindak_lanjut];
        $arrKomentarAsesor = ['komentar_asesor' => $komentar_asesor, 'elemen' => $elemen_komentar_asesor, 'kuk' => $kuk_komentar_asesor];

        /**
         * Cek rekaman terlebih dahulu, jika sudah ada update data
         */
        $cek = MemberCertificationRekaman::where('member_certification_id', $memberCertification->id)->first();
        if ($cek && $cek->count() > 0) {
            /** Update Data */
            $update = [
                'rekomendasi_asesor' => $request->get('rekomendasi_asesor'),
                'tindak_lanjut' => $arrTindakLanjut,
                'komentar_asesor' => $arrKomentarAsesor,
            ];

            if ($cek->update($update)) {
                flash()->success('Berhasil mengubah data Rekaman Asesmen');
            } else {
                flash()->error('Gagal mengubah data Rekaman Asesmen');
            }
        } else {
            /** Simpan Data */
            $rekaman = new MemberCertificationRekaman();

            $rekaman->member_certification_id = $memberCertification->id;
            $rekaman->rekomendasi_asesor      = $request->get('rekomendasi_asesor');
            $rekaman->tindak_lanjut           = $arrTindakLanjut;
            $rekaman->komentar_asesor         = $arrKomentarAsesor;

            /** Proses Simpan */
            if ($rekaman->save()) {
                flash()->success('Berhasil menyimpan data Rekaman Asesmen');
            } else {
                flash()->error('Gagal menyimpan data Rekaman Asesmen');
            }
        }

        return redirect()->route('asesmen.viewsinglepeserta', ['member_certification' => $memberCertification]);
    }
}
