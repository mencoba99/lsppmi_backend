@extends('layouts.base')
@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Element
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        @can('Elemen Kompetensi Add')
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

<div class="modal fade" id="add" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Data Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form id="form" class="kt-form kt-form--label-right">
                    <div class="kt-portlet__body">
                        <div class="kt-section kt-section--first">
                            <div class="kt-section__body">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Name :</label>
                                    <div class="col-lg-6">
                                        {!! Form::text('name',null,['id'=>'name','class'=>'form-control
                                        ','required'=>'required']) !!}
                                        {!!
                                        Form::text('id',null,['id'=>'id','class'=>'form-control','hidden'=>'hidden'])
                                        !!}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Code :</label>
                                    <div class="col-lg-6">
                                        {!! Form::text('code',null,['id'=>'code','class'=>'form-control
                                        ','required'=>'required']) !!}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Unit :</label>
                                    <div class="col-lg-6">
                                        {!! Form::select('unit',$unit,null,['id'=>'unit','class'=>'form-control input-sm
                                        kt-selectpicker','required'=>'required','data-live-search'=>"true"]) !!}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Aktif?</label>
                                    <div class="col-lg-6">
                                        <div class="kt-portlet__head-toolbar">
                                            <div class="kt-portlet__head-actions">
                                                <span class="kt-switch kt-switch--icon">
                                                    <label>
                                                        <input type="checkbox" data-url="" value="1" name="status" id="status"
                                                            class="roleParentChange roleList">
                                                        <span></span>
                                                    </label>
                                                </span>
                                            </div>
                                        </div>
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
        // minimum setup
        $('.kt-selectpicker').selectpicker();
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
    /** Validasi Form */
    form = $("#form").validate({
        rules: {
            "name": {
                required: true
            },
            "code": {
                required: true
            },
            "unit": {
                required: true
            }
        },
        messages: {
            "name": {
                required: "Silahkan tulis nama element yang akan diinput"
            },
            "code": {
                required: "Silahkan tulis kode element"
            },
            "unit": {
                required: "Silahkan pilih unit"
            }
        },
        submitHandler: function (form) {
            table = $('#datatable').DataTable().destroy();

            $.ajax({
            type: "post",
            url: "{{ route('master.element.insert') }}",
            dataType:"json",
            data: $("form").serialize(),
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
            searchDelay: 500,
            ordering: false,
            ajax: "{{ route('master.element.data') }}",
            lengthMenu: [[25, 50, 100, -1], [25, 50, 100, "All"]],
            columns: [
                { data: 'id', render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                } , title: 'No.' , width : "3%"},
                { data: 'code', name: 'code' , title: 'Code' },
                { data: 'name', name: 'name' , title: 'Name' },
                { data: 'units.name', name: 'units.name' , title: 'Units' },
                { data: 'status', name: 'status' , title: 'Status' },
                { data: 'action', name: 'action' , title: 'Action', width : "5%" }
            ]
        });
    }

    $(function() {


        view(); //call datatable view

        /* Edit Data */
        $("#datatable").on("click", "tr #edit", function() {
            $('form').trigger("reset");
            $("#id").val($(this).data('id'));
            $("#name").val($(this).data('name'));
            $("#code").val($(this).data('code'));
            $("select#unit").val($(this).data('unit'));
            // $("select#status").val($(this).data('status'));
            if($(this).data('status') == 1) {
                console.log('checked');
                $("input#status").prop('checked', true);
            } else {
                console.log('not checked');
                $("input#status").prop('checked', false);
            }
            $('.kt-selectpicker').selectpicker('refresh');
            $('#add').modal('show');
        });


        /* New Data Button */
        $('#new').click(function(event) {
            $('form').trigger("reset");
            $('.kt-selectpicker').selectpicker('refresh');
        });




    });

</script>

@endpush
