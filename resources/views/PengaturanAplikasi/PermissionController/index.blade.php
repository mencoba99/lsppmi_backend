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
                        Manajemen Permission
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <a href="#" class="btn btn-clean btn-icon-sm">
                            <i class="la la-long-arrow-left"></i>
                            Back
                        </a>
                        <a href="{{ route('permission.create') }}" class="btn btn-brand btn-icon-sm">
                            <i class="flaticon2-plus"></i> Tambah Permission
                        </a>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">
                @include('flash::message')
            </div>
            <div class="kt-portlet__body">
                <!--begin: Datatable -->
                <table class="table table-striped table-bordered table-hover table-checkable table-condensed" id="kt_table_1">
                    <thead>
                    <tr>
                        <th width="30">&nbsp;&nbsp;&nbsp;&nbsp;</th>
                        <th>Nama Permission</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <td class="nosearch"></td>
                        <td></td>
                        <td class="nosearch"></td>
                    </tr>
                    </tfoot>
                </table>

                <!--end: Datatable -->
            </div>
        </div>
    </div>

    <!-- end:: Content -->


@endsection

@push('script')
    <script src="{{ Storage::url('vendors/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {

            function format ( d ) {
                // `d` is the original data object for the row
                // var htmlShow = '<table class="table table-striped table-bordered table-hover" cellpadding="0" cellspacing="0" border="0" style="padding-left:50px;">';
                var htmlShow = '';
                $.each(d.children, function(i,item) {
                    htmlShow += '<tr>'+
                        '<td>&nbsp;</td>'+
                        '<td>'+item.name+' <small class="pull-right">('+item.name+')</small></td>'+
                        '<td>'+ item.action +'</td></tr>';
                });
                return $(htmlShow);
            }

            var table = $('#kt_table_1').DataTable({
                responsive: true,
                searchDelay: 500,
                processing: true,
                serverSide: true,
                ordering: false,
                lengthMenu: [[25, 50, 100, -1], [25, 50, 100, "All"]],
                ajax: {
                    'url': '{{ route('permission.getdata') }}',
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
                    {data: 'name',name: 'Nama', title: 'Nama Permission'},
                    {data: 'action', responsivePriority: -1},
                ],
                initComplete: function () {
                this.api().columns().every(function (i,e) {
                       // console.log(e);
                    var column = this;
                    console.log($(column.header()).text());
                    var input = document.createElement("input");
                    $(input).addClass('form-control form-control-sm').attr('placeholder','Cari '+$(column.header()).text());
                    $(input).appendTo($(column.footer()).not('.nosearch').empty())
                        .on('change', function () {
                            column.search($(this).val(), false, false, true).draw();
                        });
                });
            }
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
