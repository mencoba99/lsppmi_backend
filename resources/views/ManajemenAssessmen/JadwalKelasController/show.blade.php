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
                        <td colspan="3"><h5>Detail Kelas</h5></td>
                    </tr>
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
                                <span class="kt-badge kt-badge--inline kt-badge--success">Aktif</span>
                                @if ($jadwalKelas->is_approve == 1)
                                    <span class="kt-badge kt-badge--inline kt-badge--success">Disetujui</span>
                                @else
                                    <span class="kt-badge kt-badge--inline kt-badge--warning">Belum disetujui</span>
                                @endif
                                @if ($jadwalKelas->is_publish == 1)
                                    <span class="kt-badge kt-badge--inline kt-badge--success">Published</span>
                                @else
                                    <span class="kt-badge kt-badge--inline kt-badge--warning">Not Published</span>
                                @endif
                                @if ($jadwalKelas->is_hidden == 1)
                                    <span class="kt-badge kt-badge--inline kt-badge--warning">Tidak ditampilkan</span>
                                @else
                                    <span class="kt-badge kt-badge--inline kt-badge--success">Ditampilkan</span>
                                @endif
                            @elseif($jadwalKelas->status == 2)
                                Dibatalkan
                            @else
                                Tidak Aktif
                            @endif
                        </td>
                    </tr>
                </table>
                <table class="table table-bordered" cellpadding="4">
                    <thead>
                    <tr>
                        <th colspan="2">Data Assessor</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if ($jadwalKelas->assessor && $jadwalKelas->assessor->count() > 0)
                        @php($no=1)
                        @foreach($jadwalKelas->assessor as $item)
                            <tr>
                                <td width="20">{{ $no }}</td>
                                <td>{{ $item->name }}</td>
                            </tr>
                            @php($no++)
                        @endforeach
                    @endif
                    </tbody>
                </table>
                <table class="table table-bordered" cellpadding="4">
                    <thead>
                    <tr>
                        <th>Data Peserta</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <table class="table table-bordered" cellpadding="4" id="kt_table_1">
                                <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>No HP</th>
                                    <th>Perusahaan</th>
                                    <th>Status Pendaftaran</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="nosearch"></td>
                                </tr>
                                </tfoot>
                                <tbody>
                                @if ($jadwalKelas->pendaftar && $jadwalKelas->pendaftar->count() > 0)
                                    @foreach($jadwalKelas->pendaftar as $item)
                                        <tr>
                                            <td>{{ $item->members->name }}</td>
                                            <td>{{ $item->members->email }}</td>
                                            <td>{{ $item->members->home_phone }}</td>
                                            <td>{{ $item->members->company_name }}</td>
                                            <td>
                                                @if ($item->status == 1)
                                                    <span class="kt-badge kt-badge--inline kt-badge--primary">Pendaftaran Diterima</span>
                                                @elseif($item->status == 2)
                                                    <span class="kt-badge kt-badge--inline kt-badge--info">Menunggu Pembayaran</span>
                                                @elseif($item->status == 3)
                                                    <span class="kt-badge kt-badge--inline kt-badge--success">Menunggu APL02</span>
                                                @else
                                                    <span class="kt-badge kt-badge--inline kt-badge--danger">Ditolak</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- end:: Content -->
@endsection
@push('modal-script')
    <script src="{{ Storage::url('assets/backend/vendors/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            var table = $('#kt_table_1').DataTable({
                responsive: true,
                lengthMenu: [[25, 50, 100, -1], [25, 50, 100, "All"]],
                ordering: false,
                columns: [
                    {data: 'name'},
                    {data: 'email'},
                    {data: 'home_phone'},
                    {data: 'company_name'},
                    {data: 'status'},
                ],
                initComplete: function () {
                    this.api().columns().every(function (i,e) {
                        var column = this;
                        var input = document.createElement("input");
                        var wrapper = document.createElement('div');
                        // $(wrapper).addClass('kt-input-icon kt-input-icon--right');
                        $(input).addClass('form-control form-control-sm');
                        // $(input).appendTo(wrapper);
                        // $('<span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-search"></i></span></span>').appendTo(wrapper);
                        $(input).appendTo($(column.footer()).not('.nosearch').empty())
                            .on('change', function () {
                                column.search($(this).val(), false, false, true).draw();
                            });
                    });

                    // Restore state
                    var state = table.state.loaded();
                    if ( state ) {
                        table.columns().eq( 0 ).each( function ( colIdx ) {
                            var colSearch = state.columns[colIdx].search;

                            if ( colSearch.search ) {
                                $( 'input', table.column( colIdx ).footer() ).val( colSearch.search );
                            }
                        } );

                        table.draw();
                    }
                },
            });


        });
    </script>
@endpush

@push('modal-style')
{{--    <style type="text/css">--}}
{{--        tfoot {--}}
{{--            display: table-header-group;--}}
{{--            /*display: table-row-group;*/--}}
{{--        }--}}
{{--    </style>--}}
@endpush
