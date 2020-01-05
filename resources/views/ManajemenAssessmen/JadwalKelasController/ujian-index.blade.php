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
                        Manajemen Buka Ujian Kelas
                    </h3>
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
                        <th>Tanggal</th>
                        <th>Program</th>
                        <th>TUK</th>
                        <th>Harga</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
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
            var table = $('#kt_table_1').DataTable({
                // dom: 'Bfrtip',
                responsive: true,
                searchDelay: 500,
                processing: true,
                serverSide: true,
                ordering: false,
                lengthMenu: [[25, 50, 100, -1], [25, 50, 100, "All"]],
                ajax: {
                    'url': '{{ route('jadwal-kelas.ujian.getdata') }}',
                    'type': 'POST',
                    'headers': {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                },
                columns: [
                    {data: 'started_at', name: 'started_at', title: 'Tanggal'},
                    {data: 'tuk.name', name: 'tuk.name', title: 'Tempat Uji Kompetensi'},
                    {data: 'program.name', name: 'program.name', title: 'Program'},
                    {data: 'price', name: 'price', title: 'Harga'},
                    {data: 'action', responsivePriority: -1},
                ],
                columnDefs: [
                    {
                        render: function (data, type, row) {
                            return "Rp" + data.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
                        },
                        targets: 3
                    }
                ],
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
            $('#mod-iframe-large').on('hide.bs.modal', function (e) {
                table.ajax.reload();
            });

            $('body').on('click','.openUjian', function (e) {
                e.preventDefault();
                var jadwalId = $(this).data('id');
                
                swal.fire({
                    title: 'Buka Ujian Kelas?',
                    text: 'Apakah Anda yakin untuk mengganti status jadwal ke buka ujian?',
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
                      
                    $.ajax({
                        type: "post",
                        url: "{{ route('jadwal-kelas.ujian.set-open') }}",
                        dataType:"json",
                        data: {
                            id:jadwalId,
                        },
                        beforeSend: function() {
                            KTApp.block('#kt_content', {
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
                            table.ajax.reload();
                            if(response.status === 200) {
                               
                                setTimeout(function() {
                                    KTApp.unblock('#kt_content');
                                    swal.fire({
                                        title:"Pembukaan Ujian Kelas Berhasil",
                                        text:"Untuk Selanjutnya Pengaturan Jadwal Ujian, silahkan ke halaman jadwal ujian",
                                        type:"success",
                                        buttonsStyling:!1,
                                        confirmButtonText:"<i class='la la-gear'></i> ke Halaman Ujian",
                                        confirmButtonClass:"btn btn-danger",
                                        showCancelButton:!0,
                                        cancelButtonText:"Close",
                                        cancelButtonClass:"btn btn-default",
                                    }).then(function(result){
                                        if (result.value) {
                                            window.location.href = "{{ route('ujian.jadwal') }}";
                                        }
                                    });

                                  
                                }, 2000);

                                //
                            } else if(response.status === 500) {
                                // do something with response.message or whatever other data on error
                            }
                        }
                    })
                    return false;
                        // window.location.href = link;
                    }
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
