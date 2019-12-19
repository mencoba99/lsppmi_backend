@extends('layouts.base')
@section('content')

    <!-- begin:: Content -->
    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="kt-font-brand flaticon2-line-chart"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                        Manajemen Assessmen - Assessmen - Data Peserta
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <a href="{{ route('asesmen.index') }}" class="btn btn-clean btn-icon-sm">
                            <i class="la la-long-arrow-left"></i>
                            Back
                        </a>
                    </div>
                </div>
            </div>
            @include('flash::message')
            <div class="kt-portlet__body">
                <table class="table table-striped- table-bordered table-hover table-checkable" id="">
                    <thead>
                    <tr>
                        <th colspan="6">Detail Kelas</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td width="15%">Program</td>
                        <td width="10">:</td>
                        <td width="24%">{{ $jadwalKelas->program->name }}</td>
                        <td width="15%">Tanggal Pelaksanaan</td>
                        <td width="10">:</td>
                        <td width="">{{ date('l,d F Y', strtotime($jadwalKelas->started_at)) }}</td>
                    </tr>
                    <tr>
                        <td>Tempat Uji Kompetensi</td>
                        <td>:</td>
                        <td>{{ $jadwalKelas->tuk->name }} : {{ $jadwalKelas->tuk->address }}</td>
                        <td>Jumlah Pendaftar</td>
                        <td>:</td>
                        <td>{{ $jadwalKelas->pendaftar->count() }} Pendaftar</td>
                    </tr>
                    </tbody>
                </table>

                <table class="table table-striped- table-bordered table-hover table-checkable" id="">
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
                    @else
                        <tr>
                            <td><center>Belum Ada Assessor yang ditugaskan</center></td>
                        </tr>
                    @endif
                    </tbody>
                </table>

                <table class="table table-striped- table-bordered table-hover table-checkable" id="">
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
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="nosearch"></td>
                                    <td class="nosearch"></td>
                                </tr>
                                </tfoot>
                                <tbody>
                                @if ($jadwalKelas->pendaftar && $jadwalKelas->pendaftar->count() > 0)
                                    @foreach($jadwalKelas->pendaftar as $item)
                                        <tr>
                                            <td>
                                                <a href='{{ route('asesmen.viewsinglepeserta', ['member_certification' => $item]) }}' class='modalIframe' data-toggle='kt-tooltip' title='View' data-original-tooltip='View'>
                                                    {{ $item->members->name }}
                                                </a>
                                            </td>
                                            <td>{{ $item->members->email }}</td>
                                            <td>{{ !empty($item->members->home_phone) ? $item->members->home_phone:'-' }}</td>
                                            <td>{{ !empty($item->members->company_name) ? $item->members->company_name:'-' }}</td>
                                            <td>
                                                @if ($item->status == 1)
                                                    <span class="kt-badge kt-badge--inline kt-badge--primary">Menunggu Pembayaran</span>
                                                @elseif($item->status == 2)
                                                    <span class="kt-badge kt-badge--inline kt-badge--info">APL-02 Belum Komplit</span>
                                                @elseif($item->status == 3)
                                                    <span class="kt-badge kt-badge--inline kt-badge--success">APL02 Disetujui</span>
                                                @else
                                                    <span class="kt-badge kt-badge--inline kt-badge--danger">Revisi APL-01</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href='{{ route('asesmen.viewsinglepeserta', ['member_certification' => $item]) }}' class='btn btn-sm btn-icon btn-clean btn-icon-sm modalIframe' data-toggle='kt-tooltip' title='View' data-original-tooltip='View'>
                                                    <i class='la la-search'></i>
                                                </a>
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

@push('script')
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
                    {data: 'action'},
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
                    var state = this.api().state.loaded();
                    if ( state ) {
                        this.api().columns().eq( 0 ).each( function ( colIdx ) {
                            var colSearch = state.columns[colIdx].search;

                            if ( colSearch.search ) {
                                $( 'input', table.column( colIdx ).footer() ).val( colSearch.search );
                            }
                        } );

                        this.api().draw();
                    }
                },
            });


        });
    </script>
@endpush
