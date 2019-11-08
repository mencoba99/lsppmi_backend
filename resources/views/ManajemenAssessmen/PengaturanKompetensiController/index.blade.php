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
                        Pengaturan Kompetensi
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <a href="{{ url('/') }}" class="btn btn-clean btn-icon-sm">
                            <i class="la la-long-arrow-left"></i>
                            Back
                        </a>
                        @can('Jadwal Kelas Add')
                            <a href="{{ route('pengaturan-kompetensi.create') }}" class="btn btn-brand btn-icon-sm">
                                <i class="flaticon2-plus"></i> Tambah Pengaturan
                            </a>
                        @endcan
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">
                @include('flash::message')
            </div>
            <div class="kt-portlet__body">
                <!--begin: Datatable -->
                <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                    <thead>
                    <tr>
                        <th width="30">&nbsp;&nbsp;&nbsp;&nbsp;</th>
                        <th>Program/Kompetensi</th>
                        <th>Jenis</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <td class="nosearch"></td>
                    <td></td>
                    <td class="nosearch"></td>
                    <td class="nosearch"></td>
                    <td class="nosearch"></td>
                    </tfoot>
                </table>

                <!--end: Datatable -->
            </div>
        </div>
    </div>

    <!-- end:: Content -->
@endsection


@push('script')
    <script src="{{ Storage::url('assets/backend/vendors/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {

            function format ( d ) {
                // `d` is the original data object for the row
                // var htmlShow = '<table class="table table-striped table-bordered table-hover" cellpadding="0" cellspacing="0" border="0" style="padding-left:50px;">';
                var htmlShow = ''; tipe = '';
                $.each(d.unit_kompetensi, function(i,item) {
                    if (item.pivot.is_required == 1) {
                        tipe = '<span class="kt-badge kt-badge--inline kt-badge--success">Kompetensi Inti</span>';
                    } else {
                        tipe = '<span class="kt-badge kt-badge--inline kt-badge--warning">Kompetensi Pilihan</span>';
                    }
                    htmlShow += '<tr>'+
                        '<td>&nbsp;</td>'+
                        '<td>'+item.name+' </td>'+
                        '<td>'+ tipe +'</td>'+
                        '<td>'+ item.status +'</td>'+
                        '<td>'+ item.action +'</td></tr>';
                });
                return $(htmlShow);
            }

            var table = $('#kt_table_1').DataTable({
                // dom: 'Bfrtip',
                responsive: true,
                searchDelay: 500,
                processing: true,
                serverSide: true,
                ordering: false,
                lengthMenu: [[25, 50, 100, -1], [25, 50, 100, "All"]],
                ajax: {
                    'url': '{{ route('pengaturan-kompetensi.getdata') }}',
                    'type': 'POST',
                    'headers': {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                },
                columns: [
                    {
                        className:      'details-control',
                        orderable:      false,
                        searchable: false,
                        data:           'viewdetail',
                        defaultContent: ''
                    },
                    {data: 'name', name: 'name', title: 'Program'},
                    {data: 'is_required', name: 'is_required', title: 'Jenis'},
                    {data: 'status', name: 'status', title: 'Status'},
                    {data: 'action', responsivePriority: -1},
                ],
                // columnDefs: [
                //     {
                //         render: function (data, type, row) {
                //             console.log(data);
                //             if (data === 1) {
                //                 return 'Inti';
                //             } else if(data === 2) {
                //                 return 'Pilihan';
                //             } else {
                //                 return '';
                //             }
                //         },
                //         targets: 2
                //     }
                // ],
                initComplete: function () {
                    this.api().columns().every(function (i,e) {
//                        console.log(i);
                        var column = this;
                        var input = document.createElement("input");
                        var wrapper = document.createElement('div');
                        $(wrapper).addClass('kt-input-icon kt-input-icon--right');
                        $(input).addClass('form-control form-control-sm');
                        $(input).appendTo(wrapper);
                        $('<span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-search"></i></span></span>').appendTo(wrapper);
                        $(wrapper).appendTo($(column.footer()).not('.nosearch').empty())
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
                                console.log(table.column( colIdx ).footer());
                                $( 'input', table.column( colIdx ).footer() ).val( colSearch.search );
                            }
                        } );

                        table.draw();
                    }
                },
                // dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"
            });



            // Add event listener for opening and closing details
            $('#kt_table_1 tbody').on('click', 'td.details-control', function () {
                var tr = $(this).closest('tr');

                var row = table.row( tr );
                if ( row.child.isShown() ) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                }
                else {
                    // Open this row
                    row.child( format(row.data()) ).show();
//                    row.child( ['SATU','DUA','TIGA'] ).show();
                    tr.addClass('shown');
                }

                $('.showtooltip').tooltip({
                    container: 'body',
                    html: true,
                    title: 'Info'
                });
            });
        })
    </script>
@endpush

@push('style')
    <style type="text/css">
        tfoot {
            display: table-header-group;
        }
    </style>
@endpush
