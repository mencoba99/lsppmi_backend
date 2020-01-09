@extends('layouts.modal.base')
@section('content')

    <!-- begin:: Content -->
    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">


        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="kt-font-brand flaticon-presentation"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                        Data Kelas {{ $jadwalKelas->program->name }} ( {{ date('d F Y', strtotime($jadwalKelas->started_at)) }} )
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                @include('flash::message')
                <table class="table table-bordered" cellpadding="4">
                    <tr>
                        <td width="20%">Program</td>
                        <td width="20">:</td>
                        <td>{{ $jadwalKelas->program->name }}</td>
                    </tr>
                    <tr>
                        <td>Tanggal Pelaksanaan</td>
                        <td>:</td>
                        <td>{{ date('d F Y', strtotime($jadwalKelas->started_at)) }}</td>
                    </tr>
                    <tr>
                        <td>Tempat Uji Kompetensi (TUK)</td>
                        <td>:</td>
                        <td>{{ $jadwalKelas->tuk->name }}</td>
                    </tr>
                    <tr>
                        <td>Harga</td>
                        <td>:</td>
                        <td>Rp{{ number_format($jadwalKelas->price) }}</td>
                    </tr>
                    <tr>
                        <td>Minimal Peserta</td>
                        <td>:</td>
                        <td>{{ $jadwalKelas->min_participants }} Peserta</td>
                    </tr>
                    <tr>
                        <td>Maksimal Peserta</td>
                        <td>:</td>
                        <td>{{ $jadwalKelas->max_participants }} Peserta</td>
                    </tr>
                    <tr>
                        <td>Durasi Ujian</td>
                        <td>:</td>
                        <td>{{ number_format($jadwalKelas->exam_duration,0) }} Hari</td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>:</td>
                        <td>
                            @if ($jadwalKelas->status == 1)
                                Aktif
                            @elseif($jadwalKelas->status == 2)
                                Dibatalkan
                            @else
                                Tidak Aktif
                            @endif
                        </td>
                    </tr>
                    @canany(['Jadwal Kelas Approve'])
                        @if ($jadwalKelas->registration_closed == 0)
                            <tr>
                                <td colspan="3" align="center" style="padding: 8px;">
                                    <a href="{{ route('jadwal-kelas.register.set-approve',['jadwal_kelas'=>$jadwalKelas,'status'=>'tutuppendaftaran']) }}" class="btn btn-success approveJadwal btn-loading">Tutup Pendaftaran Kelas</a>
                                </td>
                            </tr>
                        @else
                            <tr>
                                <td colspan="3" align="center" style="padding: 8px;">
                                    <a href="{{ route('jadwal-kelas.register.set-approve',['jadwal_kelas'=>$jadwalKelas,'status'=>'bukapendaftaran']) }}" class="btn btn-danger unapproveJadwal btn-loading">Buka Pendaftaran Kelas</a>
                                </td>
                            </tr>
                        @endif
                    @endcanany
                </table>
            </div>
        </div>
    </div>

    <!-- end:: Content -->

@endsection

@push('modal-script')
    <script type="text/javascript">
        $(document).ready(function () {
            $('body').on('click','.delconfirm', function (e) {
                e.preventDefault();
                var link = $(this).attr('href');
                swal.fire({
                    title: 'Hapus data?',
                    text: 'Apakah Anda yakin untuk hapus data ini ?',
                    type: 'warning',
                    allowOutsideClick: true,
                    showConfirmButton: true,
                    showCancelButton: true,
                    confirmButtonClass: 'btn-info',
                    cancelButtonClass: 'btn-danger',
                    // closeOnConfirm: true,
                    // closeOnCancel: true,
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Tidak',
                }).then(function(result){
                    if (result.value) {
                        window.location.href = link;
                    }
                });
            });

            $('body').on('click','.approveJadwal', function (e) {
                e.preventDefault();
                var link = $(this).attr('href');
                swal.fire({
                    title: 'Approve Jadwal?',
                    text: 'Apakah Anda yakin untuk Menutup Pendaftaran Jadwal ini?',
                    type: 'warning',
                    allowOutsideClick: true,
                    showConfirmButton: true,
                    showCancelButton: true,
                    confirmButtonClass: 'btn-info',
                    cancelButtonClass: 'btn-danger',
                    // closeOnConfirm: true,
                    // closeOnCancel: true,
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Tidak',
                }).then(function(result){
                    if (result.value) {
                        window.location.href = link;
                    }
                });
            });

            $('body').on('click','.unapproveJadwal', function (e) {
                e.preventDefault();
                var link = $(this).attr('href');
                swal.fire({
                    title: 'Batalkan Approve Jadwal?',
                    text: 'Apakah Anda yakin untuk membatalkan Penutupan Pendaftaran Jadwal ini?',
                    type: 'warning',
                    allowOutsideClick: true,
                    showConfirmButton: true,
                    showCancelButton: true,
                    confirmButtonClass: 'btn-info',
                    cancelButtonClass: 'btn-danger',
                    // closeOnConfirm: true,
                    // closeOnCancel: true,
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Tidak',
                }).then(function(result){
                    if (result.value) {
                        window.location.href = link;
                    }
                });
            });


        });
    </script>
@endpush
