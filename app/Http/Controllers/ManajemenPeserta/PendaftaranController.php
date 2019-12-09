<?php

namespace App\Http\Controllers\ManajemenPeserta;

use App\Http\Controllers\Controller;
use App\Models\MemberCertification;
use App\Models\ProgramSchedule;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PendaftaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pemilihanAsesorIndex()
    {
        return view('ManajemenPeserta.PendaftaranController.pemilihan-asesor-index');
    }

    public function getPemilihanAsesorData(DataTables $dataTables)
    {
        $jadwalKelas = ProgramSchedule::where('is_publish', 1)->where('status', 1)->get();
        $jadwalKelas->load('program', 'tuk');

        $jadwalKelasJson = $dataTables->of($jadwalKelas)->addColumn('action', function (ProgramSchedule $jadwalKelas) {
            $action = "<a href='" . route('jadwal-kelas.show', ['jadwal_kela' => $jadwalKelas]) . "' class='btn btn-sm btn-icon btn-clean btn-icon-sm modalIframe' data-toggle='kt-tooltip' title='View " . $jadwalKelas->program->name . "' data-original-tooltip='View " . $jadwalKelas->program->name . "'>
                              <i class='la la-search'></i>
                            </a>";
            if (auth()->user()->can('Jadwal Kelas Edit')) {
                $action .= "<a href='" . route('pendaftaran.viewallpeserta', ['jadwal_kelas' => $jadwalKelas]) . "' class='btn btn-sm btn-icon btn-clean btn-icon-sm' data-toggle='kt-tooltip' title='Data Peserta' data-original-tooltip='Data Peserta'>
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function viewAllPeserta(ProgramSchedule $jadwalKelas)
    {
        return view('ManajemenPeserta.PendaftaranController.pemilihan-asesor-viewpeserta', compact('jadwalKelas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param ProgramSchedule $jadwalKelas
     * @param MemberCertification $memberCertification
     * @return void
     */
    public function setAsesor(Request $request, MemberCertification $memberCertification)
    {
//        return $memberCertification->schedules->assessor;
        return view('ManajemenPeserta.PendaftaranController.pemilihan-asesor-setasesor', compact('memberCertification'));
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param MemberCertification $memberCertification
     * @return void
     */
    public function saveAsesor(Request $request, MemberCertification $memberCertification)
    {
        $request->validate([
                                'assessor_id' => 'required'
                           ]);

        if ($memberCertification->update(['assessor_id'=>$request->get('assessor_id')])) {
            flash()->success('Berhasil menetapkan Asesor');
        } else {
            flash()->error('Gagal menetapkan Asesor');
        }
        return redirect()->route('pendaftaran.pemilihanasesor.setasesor',['member_certification'=>$memberCertification]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
