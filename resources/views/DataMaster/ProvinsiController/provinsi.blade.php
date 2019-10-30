@extends('layouts.base')

@section('content')

    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
        <div class="alert alert-light alert-elevate" role="alert">
            <div class="alert-icon"><i class="flaticon-warning kt-font-brand"></i></div>
            <div class="alert-text">
                Ini adalah menu data provinsi.
            </div>
        </div>
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                    <h3 class="kt-portlet__head-title">
                        Provinsi
                    </h3>
                </div>
                @can('Provinsi Add')
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">
                            <button type="button" id="new" class="btn btn-brand btn-elevate btn-icon-sm"
                                    data-toggle="modal" data-target="#add"><i class="la la-plus"></i>
                                Tambah Data
                            </button>
                            &nbsp;
                        </div>
                    </div>
                </div>
                @endcan
            </div>
            <div class="kt-portlet__body tabel-provinsi">
                <table
                    class="table table-striped- table-bordered table-hover table-checkable dataTable no-footer dtr-inline"
                    id="datatable">
                    <thead>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
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

            </div>
        </div>
    </div>
    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Data Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form">
                        <div class="form-group">
                            <label for="recipient-name" class="form-control-label">Nama Provinsi:</label>
                            <input type="text" class="form-control" name="provinsi_nm" id="provinsi_nm">
                            <input type="text" class="form-control " style="display:none" name="id_provinsi[]"
                                   id="provinsi_id">
                        </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id="simpan" class="submit btn btn-brand btn-elevate btn-icon-sm">Simpan
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('script')

    <script src="{{ Storage::url('assets/backend/vendors/custom/datatables/datatables.bundle.js') }}"
            type="text/javascript"></script>
    <script type="text/javascript">
        function view() {
            $('#datatable').DataTable().destroy();
            form = $("#form").validate({
                rules: {
                    "provinsi_nm": {
                        required: true
                    }

                },
                messages: {
                    "provinsi_nm": {
                        required: "Silahkan tulis nama provinsi yang akan diinput "
                    }
                },
                submitHandler: function (form) { // for demo
                    table = $('#datatable').DataTable().destroy();
                    $.ajax({
                        type: "post",
                        url: "{{ route('master.provinsi.insert') }}",
                        dataType: "json",
                        data: {
                            nm_provinsi: $("#provinsi_nm").val(),
                            id_provinsi: $("#provinsi_id").val(),
                        },
                        beforeSend: function () {
                            KTApp.block('#add .modal-content', {
                                overlayColor: '#000000',
                                type: 'v2',
                                state: 'primary',
                                message: 'Processing...'
                            });
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (response) {
                            // alert(JSON.stringify(response));
                            if (response.status === 200) {
                                view();
                                setTimeout(function () {
                                    KTApp.unblock('#add .modal-content');
                                    $('#add').modal('hide');
                                }, 2000);

                                //
                            } else if (response.status === 500) {
                                // do something with response.message or whatever other data on error
                            }
                        }
                    })
                    return false;
                    event.preventDefault();
                }
            });
            var table = $('#datatable').DataTable({
                responsive: true,
                searchDelay: 500,
                processing: true,
                serverSide: true,
                ordering: false,
                lengthMenu: [[25, 50, 100, -1], [25, 50, 100, "All"]],
                ajax: "{{ route('master.provinsi.data') }}",
                columns: [
                    {
                        data: 'id', render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }, title: 'No.', width: "3%"
                    },
                    {data: 'name', name: 'name', title: 'Nama Provinsi'},
                    // { data: 'created_at', name: 'created_at' , title: 'Created At' },
                    // { data: 'updated_at', name: 'updated_at' , title: 'Update At' },
                    {data: 'action', name: 'action', title: 'Action', width: "5%"}
                ],
                initComplete: function () {
                    this.api().columns().every(function (i,e) {
//                        console.log(i);
                        var column = this;
                        var input = document.createElement("input");
                        var wrapper = document.createElement('div');
                        // $(wrapper).addClass('kt-input-icon kt-input-icon--right');
                        $(input).addClass('form-control form-control-sm');
                        // $(input).appendTo(wrapper);
                        $('<span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-search"></i></span></span>').appendTo(wrapper);
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
                                console.log(table.column( colIdx ).footer());
                                $( 'input', table.column( colIdx ).footer() ).val( colSearch.search );
                            }
                        } );

                        table.draw();
                    }
                },
            });


        }

        $(function () {


            view();
            $("#datatable").on("click", "tr #edit", function () {
                data = $(this).data('id');
                nama = $(this).data('nama');
                $("#provinsi_id").val(data);
                $("#provinsi_nm").val(nama);
                $('#add').modal('show');


            });


            $('#new').click(function (event) {
                $("input").val("");
            });


        });

    </script>

@endpush
@push('style')
    <style type="text/css">
        tfoot {
            display: table-header-group;
        }
    </style>
@endpush
