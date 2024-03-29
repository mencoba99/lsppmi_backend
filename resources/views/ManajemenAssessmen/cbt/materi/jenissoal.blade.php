@extends('layouts.base')
@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-list-3"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Jenis Soal
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        @can('Jenis Soal Add')
                        <button type="button" id="new" class="btn btn-brand btn-elevate btn-icon-sm" data-toggle="modal"
                            data-target="#add"><i class="la la-plus"></i>
                            Tambah Data</button>
                        &nbsp;
                        @endcan
                    </div>
                </div>
            </div>
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
                        <td></td>
                        <td></td>
                        <td class="nosearch"></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="add" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                    <label class="col-lg-3 col-form-label">Jenis Soal:</label>
                                    <div class="col-lg-6">
                                        {!!
                                        Form::text('jenis_soal_nm',null,['id'=>'jenis_soal_nm','class'=>'form-control
                                        ','required'=>'required']) !!}
                                        {!!
                                        Form::text('jenis_soal_id',null,['id'=>'jenis_soal_id','class'=>'form-control','hidden'=>'hidden'])
                                        !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" id="simpan" class="btn btn-brand btn-elevate btn-icon-sm">Simpan</button>
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

        KTApp.blockPage(), setTimeout(function () {
                KTApp.unblockPage()
            }, 2e3);
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
            "jenis_soal_nm": {
                required: true
            },

        },
        messages: {
            "jenis_soal_nm": {
                required: "Silahkan tulis jenis soal yang akan diinput "
            }
        },
        submitHandler: function (form) { 
            table = $('#datatable').DataTable().destroy();
            $.ajax({
                type: "post",
                url: "{{ route('materi.jenis-soal.insert') }}",
                dataType:"json",
                data: {
                    name: $("#jenis_soal_nm").val(),
                    id: $("#jenis_soal_id").val(),
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
                        }, 2000);
                        
            //          
                    } else if(response.status === 500) {
                        // do something with response.message or whatever other data on error
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
            ajax: "{{ route('materi.jenis-soal.data') }}",
            columns: [
                { data: 'id', render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                } , title: 'No.', width : "3%" },
                { data: 'name', name: 'name' , title: 'Jenis Soal' },
                { data: 'action', name: 'action' , title: 'Action', width : "5%" }
            ]
    });
    }

    $(function() {

        
        view(); //call datatable view


        /* Edit Data */
        $("#datatable").on("click", "tr #edit", function() { 
            $("input").val(""); 
            form.resetForm();
           
            $("#jenis_soal_id").val($(this).data('id'));
            $("#jenis_soal_nm").val($(this).data('nama'));
            $('#add').modal('show');
        });


        /* New Data Button */
        $('#new').click(function(event) {
            $("input").val("");
            form.resetForm();
        });

        

   
    });
    
</script>   
   
@endpush
