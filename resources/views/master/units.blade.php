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
                    Units
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        <button type="button" id="new" class="btn btn-brand btn-elevate btn-icon-sm" data-toggle="modal" data-target="#add"><i class="la la-plus"></i>
                            Tambah Data</button>
                        &nbsp;
                        {{-- <a href="#add" data-toggle="modal" class="btn btn-brand btn-elevate btn-icon-sm">
                            <i class="la la-plus"></i>
                            New Record
                        </a> --}}
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
    <div class="modal-dialog modal-md" role="document">
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
                                            <label class="col-lg-3 col-form-label">Nama Unit:</label>
                                            <div class="col-lg-6">
                                                {!! Form::text('name',null,['id'=>'name','class'=>'form-control ','required'=>'required']) !!}
                                                {!! Form::text('id',null,['id'=>'id','class'=>'form-control','hidden'=>'hidden']) !!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label">Code Unit:</label>
                                            <div class="col-lg-6">
                                                {!! Form::text('code',null,['id'=>'code','class'=>'form-control ','required'=>'required']) !!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label">Type Program:</label>
                                            <div class="col-lg-6">
                                                    {!! Form::select('type',$type,null,['id'=>'type','class'=>'form-control input-sm kt-selectpicker','required'=>'required','data-live-search'=>"true",'placeholder'=>'Pilih Kategori']) !!}
                                                
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label">Status:</label>
                                            <div class="col-lg-6">
                                                    {!! Form::select('status',[
                                                        '0'  => 'Non Aktif',
                                                        '1' => 'Aktif'
                                                    ],null,['id'=>'status','class'=>'form-control input-sm kt-selectpicker','required'=>'required','data-live-search'=>"true",'placeholder'=>'Pilih Status']) !!}
                                                
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

@push('scripts')
  
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
    form = $("#form").validate({
        rules: {
            "name": {
                required: true
            },
            "code": {
                required: true
            },
            "type": {
                required: true
            },
            "status": {
                required: true
            }

        },
        messages: {
            "name": {
                required: "Silahkan tulis nama unit yang akan diinput"
            },
            "code": {
                required: "Silahkan tulis kode unit"
            },
            "type": {
                required: "Silahkan pilih kategori"
            },
            "status": {
                required: "Silahkan pilih status"
            }
        },
        submitHandler: function (form) { // for demo
            table = $('#datatable').DataTable().destroy();
        

        $.ajax({
            type: "post",
            url: "{{ route('master.units.insert') }}",
            dataType:"json",
            data: {
                name: $("#name").val(),
                id: $("#id").val(),
                code: $("#code").val(),
                status: $("#status").val(),
                type: $("#type").val(),
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
        }
    });
});

  function view(){
    $('#datatable').DataTable().destroy(); // destroy datatable
    /* Datatable View */
    $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('master.units.data') }}",
            columns: [
                { data: 'id', render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                } , title: 'No.' , width : "3%"},
                { data: 'code', name: 'code' , title: 'Code' },
                { data: 'name', name: 'name' , title: 'Name' },
                { data: 'type.name', name: 'type' , title: 'Type' },
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
            $("select#type").val($(this).data('type'));
            $("select#status").val($(this).data('status'));
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
