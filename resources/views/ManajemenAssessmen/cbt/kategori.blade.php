@extends('layouts.base')

@section('content')

<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-tag"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                  Kategori
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        @can('Kategori Program Add')
                            <button type="button" id="new" class="btn btn-brand btn-elevate btn-icon-sm" data-toggle="modal" data-target="#add">
                                <i class="la la-plus"></i>
                                Tambah  Data
                            </button>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body tabel-provinsi">
            <table class="table table-striped- table-bordered table-hover table-checkable dataTable no-footer dtr-inline" id="datatable">
                <thead>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="nosearch"></td>
                </tr>
                </tfoot>
            </table>

        </div>
    </div>
</div>

<div class="modal fade" id="add"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                    <form id="form" class="kt-form kt-form--label-right">
                            <div class="kt-portlet__body">
                                <div class="kt-section kt-section--first">

                                    <div class="kt-section__body">
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label">Nama Kategori:</label>
                                            <div class="col-lg-6">
                                                {!! Form::text('kategori_nm',null,['id'=>'kategori_nm','class'=>'form-control ','required'=>'required']) !!}
                                                {!! Form::text('kategori_id',null,['id'=>'kategori_id','class'=>'form-control','hidden'=>'hidden']) !!}

                                            </div>
                                        </div>
                                        <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Kode:</label>
                                                <div class="col-lg-6">
                                                    {!! Form::text('kategori_code',null,['id'=>'kategori_code','class'=>'form-control ','required'=>'required']) !!}

                                                </div>
                                        </div>
                                        <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Keterangan:</label>
                                                <div class="col-lg-6">
                                                    {!! Form::textarea('kategori_desc',null,['id'=>'kategori_desc','class'=>'form-control ','required'=>'required']) !!}

                                                </div>
                                        </div>
                                        <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Status:</label>
                                                <div class="col-lg-4 ">
                                                    {!! Form::select('status',$status,null,['id'=>'status','class'=>'form-control input-sm kt-selectpicker','required'=>'required','data-live-search'=>"true",'placeholder'=>'Pilih Status']) !!}
                                                </div>
                                            </div>
                                    </div>

                                </div>
                            </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" id="simpan" class="submit btn btn-brand btn-elevate btn-icon-sm">Simpan</button>
            </div>
        </form>


        </div>
    </div>
</div>

@endsection

@push('script')
<script src="{{ Storage::url('assets/backend/vendors/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
<script type="text/javascript">


    var KTBootstrapSelect = function () {

    // Private functions
    var demos = function () {
        $('.kt-selectpicker').selectpicker().change(function(){
            $(this).valid()
        });
    }

    return {
        // public functions
        init: function() {
            demos();
        }
    };
}();

jQuery(document).ready(function() {
    KTBootstrapSelect.init();
    form = $("#form").validate({
        rules: {
            "kategori_nm": {
                required: true
            },
            "kategori_code": {
                required: true
            },
            "kategori_desc": {
                required: true
            },
            "status": {
                required: true
            }

        },
        messages: {
            "kategori_nm": {
                required: "Silahkan tulis nama kategori yang akan diinput "
            },
            "kategori_code": {
                required: "Silahkan tulis kode yang akan diinput"
            },
            "kategori_desc": {
                required: "Silahkan tulis keterangan yang akan diinput"
            },
            "status": {
                required: "Silahkan pilih status"
            }
        },
        submitHandler: function (form) { // for demo
               table = $('#datatable').DataTable().destroy();


            $.ajax({
                type: "post",
                url: "{{ route('ujian-komputer.kategori.insert') }}",
                dataType:"json",
                data: {
                    name: $("#kategori_nm").val(),
                    id: $("#kategori_id").val(),
                    code: $("#kategori_code").val(),
                    desc: $("#kategori_desc").val(),
                    status: $("#status").val(),
                },
                beforeSend: function() {
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
                    if(response.status === 200) {
                        view();
                        setTimeout(function() {
                            KTApp.unblock('#add .modal-content');
                            $('#add').modal('hide');
                            $.notify({
                                // options
                                message: 'Berhasil disimpan'
                            },{
                                // settings
                                type: 'success',
                                placement: {
                                    from: "top",
                                    align: "right"
                                }
                            });
                        }, 2000);

            //
                    } else if(response.status === 500) {
                        $.notify({
                                // options
                                message: 'Error'
                            },{
                                // settings
                                type: 'danger',
                                placement: {
                                    from: "top",
                                    align: "right"
                                }
                            });
                    }
                }
            })
            return false;
            event.preventDefault();
        }
    });
});

  function view(){
    $('#datatable').DataTable().destroy(); // destroy datatable
    /* Datatable View */
    $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('ujian-komputer.kategori.data') }}",
            columns: [
                { data: 'id', render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                } , title: 'No.', width : "3%" },
                { data: 'code', name: 'code' , title: 'Kode ' },
                { data: 'name', name: 'name' , title: 'Nama Kategori' },
                { data: 'description', name: 'description' , title: 'Keterangan' },
                { data: 'status', name: 'status' , title: 'Status', width : "10%" },
                { data: 'action', name: 'action' , title: 'Action', width : "5%" },
            ]
    });
    }

    $(function() {


        view(); //call datatable view


        /* Edit Data */
        $("#datatable").on("click", "tr #edit", function() {
            $("input").val("");
            form.resetForm();
            $("#kategori_id").val($(this).data('id'));
            $("#kategori_code").val($(this).data('code'));
            $("#kategori_desc").val($(this).data('desc'));
            $("#kategori_nm").val($(this).data('nama'));
            $("select#status").val($(this).data('status'));
            $('.kt-selectpicker').selectpicker('refresh');
            $("#simpan").show();

            $('#add').modal('show');
        });



        /* New Data Button */
        $('#new').click(function(event) {
            $("input").val("");
            $("textarea").val("");
            $("select").val("");
            $('.kt-selectpicker').selectpicker('refresh');
            form.resetForm();
            $("#simpan").show();
        });

    });

</script>

@endpush
