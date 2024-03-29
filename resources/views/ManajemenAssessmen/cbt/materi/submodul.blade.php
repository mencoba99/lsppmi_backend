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
                  Submodul
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        @can('Submodul Add')
                        <button type="button" id="new" class="btn btn-brand btn-elevate btn-icon-sm" data-toggle="modal" data-target="#add"><i class="la la-plus"></i>
                            Tambah Data</button>
                        &nbsp;
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
                <h5 class="modal-title" id="exampleModalLabel">Tambah  Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                    <form id="form" class="kt-form kt-form--label-right">
                            <div class="kt-portlet__body">
                                <div class="kt-section kt-section--first">
                                    
                                    <div class="kt-section__body">
                                            <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Modul:</label>
                                                    <div class="col-lg-6">
                                                        {!! Form::select('id_modul',$Modul,null,['id'=>'id_modul','class'=>'form-control input-sm kt-selectpicker','required'=>'required','data-live-search'=>"true"]) !!}
                                                        {!! Form::text('id',null,['id'=>'id','class'=>'form-control','hidden'=>'hidden']) !!}
                                                       
                                                    </div>
                                                </div>
                                        <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Sub Modul:</label>
                                                <div class="col-lg-6">
                                                    {!! Form::text('name',null,['id'=>'name','class'=>'form-control ','required'=>'required']) !!}
                                                  
                                                </div>
                                        </div>
                                        <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Keterangan:</label>
                                                <div class="col-lg-6">
                                                    {!! Form::textarea('desc',null,['id'=>'desc','class'=>'form-control ','required'=>'required']) !!}
                                                   
                                                </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label">Status:</label>
                                            <div class="col-lg-6">
                                                    <div class="kt-portlet__head-toolbar">
                                                            <div class="kt-portlet__head-actions">
                                                                <span class="kt-switch kt-switch--icon">
                                                                    <label>
                                                                        
                                                                        <input type="checkbox" data-url="" name="status" id="status" class="roleParentChange roleList">
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
            "id_modul": {
                required: true
            },
            "submodul_name": {
                required: true
            },
            "submodul_desc": {
                required: true
            }

        },
        messages: {
            "id_modul": {
                required: "Silahkan pilih modul"
            },
            "submodul_name": {
                required: "Silahkan input nama submodul"
            },
            "submodul_desc": {
                required: "Silahkan input keterangan"
            }
        },
        submitHandler: function (form) { // for demo
            table = $('#datatable').DataTable().destroy();
                if($("#status").is(':checked')){
                    cekstatus = true;
                }else{
                    cekstatus = false;
                }

                

            $.ajax({
                type: "post",
                url: "{{ route('materi.pembuatan-submodul.insert') }}",
                dataType:"json",
                data:{
                    status: cekstatus,
                    desc: $("#desc").val(),
                    id_modul: $("#id_modul").val(),
                    name: $("#name").val(),
                    id: $("#id").val(),

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
            ajax: "{{ route('materi.pembuatan-submodul.data') }}",
            columns: [
                { data: 'id', render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                } , title: 'No.', width : "3%" },
                { data: 'name', name: 'name' , title: 'Nama Sub Modul' },
                { data: 'modul.name', name: 'modul.name' , title: 'Modul ' },
                { data: 'description', name: 'description' , title: 'Keterangan' },
                { data: 'status_s', name: 'status_s' , title: 'Status', width : "5%" },
                { data: 'action', name: 'action' , title: 'Action', width : "5%"  }
            ],
            initComplete: function () {
            this.api().columns(2).every( function () {
                var column = this;
                var select = $('<select class="form-control input-sm kt-selectpicker" data-live-search="true" data-live-search-style="startsWith" placeholder="filter by modul"><option value=""></option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
    });
    }

    $(function() {


        view(); //call datatable view


        /* Edit Data */
        $("#datatable").on("click", "tr #edit", function() { 
             $("input").val(""); 
             form.resetForm();
            $("#id").val($(this).data('id'));
            $("#id_modul").val($(this).data('modul'));
            $("#name").val($(this).data('nama'));
            $("#desc").val($(this).data('desc'));
           if($(this).data('aktif')==1){
            $("#status").prop("checked",true);
           }
            
           
           
            $('#add').modal('show');
        });


        /* New Data Button */
        $('#new').click(function(event) {
            $("input").val("");
            $("textarea").val("");
            $("select").val("");
            $('.kt-selectpicker').selectpicker('refresh');
            form.resetForm();
        });

    });
    
</script>   
   
@endpush


@push('style')
<style>
        tfoot {
             display: table-header-group;
        }
        </style>
@endpush
