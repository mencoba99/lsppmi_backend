@extends('layouts.base')

@section('content')

<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
    <div class="alert alert-light alert-elevate" role="alert">
        <div class="alert-icon"><i class="flaticon-warning kt-font-brand"></i></div>
        <div class="alert-text">
            {{$Title}}
            <br>For more info see <a class="kt-link kt-font-bold" href="https://datatables.net/" target="_blank">the official home</a> of the plugin.
        </div>
    </div>
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                        {{ucfirst(trans(end($crumbs)))}}
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        <button type="button" id="new" class="btn btn-brand btn-elevate btn-icon-sm" data-toggle="modal" data-target="#add"><i class="la la-plus"></i>
                            Tambah  {{ucfirst(trans(end($crumbs)))}}</button>
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
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Data Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                    <form class="kt-form kt-form--label-right" onsubmit="return false;">
                            <div class="kt-portlet__body">
                                <div class="kt-section kt-section--first">
                                    
                                    <div class="kt-section__body">
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label">Kategori:</label>
                                            <div class="col-lg-6">
                                                {!! Form::select('kategori_id',$Kategori,null,['id'=>'kategori_id','class'=>'form-control input-sm kt-selectpicker','required'=>'required','data-live-search'=>"true",'placeholder'=>'Pilih Kategori']) !!}
                                                {!! Form::text('program_id',null,['id'=>'program_id','class'=>'form-control','hidden'=>'hidden']) !!}
                                               <span class="form-text text-muted">Silahkan tulis nama kategori yang akan diinput.</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Kode Program:</label>
                                                <div class="col-lg-6">
                                                    {!! Form::text('program_code',null,['id'=>'program_code','class'=>'form-control ','required'=>'required']) !!}
                                                   <span class="form-text text-muted">Silahkan tulis kode yang akan diinput.</span>
                                                </div>
                                        </div>
                                        <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Nama Program:</label>
                                                <div class="col-lg-6">
                                                    {!! Form::text('program_name',null,['id'=>'program_name','class'=>'form-control ','required'=>'required']) !!}
                                                   <span class="form-text text-muted">Silahkan tulis kode yang akan diinput.</span>
                                                </div>
                                        </div>
                                        <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Singkatan Ind:</label>
                                                <div class="col-lg-6">
                                                    {!! Form::text('program_sing_ind',null,['id'=>'program_sing_ind','class'=>'form-control ','required'=>'required']) !!}
                                                   <span class="form-text text-muted">Silahkan tulis kode yang akan diinput.</span>
                                                </div>
                                        </div>
                                        <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Singkatan Eng:</label>
                                                <div class="col-lg-6">
                                                    {!! Form::text('program_sing_eng',null,['id'=>'program_sing_eng','class'=>'form-control ','required'=>'required']) !!}
                                                   <span class="form-text text-muted">Silahkan tulis kode yang akan diinput.</span>
                                                </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label">Level:</label>
                                            <div class="col-lg-2">
                                                {!! Form::select('level',$level,null,['id'=>'level','class'=>'form-control input-sm kt-selectpicker','required'=>'required','data-live-search'=>"true",'placeholder'=>'Pilih Level']) !!}
                                               <span class="form-text text-muted">Silahkan tulis kode yang akan diinput.</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Harga:</label>
                                                <div class="col-lg-6">
                                                    {!! Form::text('program_harga',null,['id'=>'program_harga','class'=>'form-control ','required'=>'required']) !!}
                                                   <span class="form-text text-muted">Silahkan tulis kode yang akan diinput.</span>
                                                </div>
                                        </div>
                                        <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Keterangan:</label>
                                                <div class="col-lg-6">
                                                        
                                                    {!! Form::text('program_desc',null,['id'=>'program_desc','class'=>'summernote form-control ','required'=>'required']) !!}
                                                   <span class="form-text text-muted">Silahkan tulis keterangan yang akan diinput.</span>
                                                </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label">Status:</label>
                                            <div class="col-lg-2">
                                                {!! Form::select('status',$status,null,['id'=>'status','class'=>'form-control input-sm kt-selectpicker','required'=>'required','data-live-search'=>"true",'placeholder'=>'Pilih Level']) !!}
                                               <span class="form-text text-muted">Silahkan tulis kode yang akan diinput.</span>
                                            </div>
                                        </div>
                                    </div>
            
            
                                </div>
                            </div>
                            
                      
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" id="simpan" class="btn btn-primary">Simpan</button>
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
        $('.summernote').summernote({
            height: 150
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
});

  function view(){
    $('#datatable').DataTable().destroy(); // destroy datatable
    /* Datatable View */
     $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: "{{ route('mgt.cbt.program.data') }}",
            columns: [
                { data: 'id', render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                } , title: 'No.' },
                { data: 'code', name: 'code' , title: 'Kode ' },
                { data: 'name', name: 'name' , title: 'Nama Program' },
                { data: 'kategori.name', name: 'kategori.name' , title: 'Kategori' },
                { data: 'sing_ind', name: 'name' , title: 'Singkatan Ind' },
                { data: 'sing_int', name: 'name' , title: 'Singkatan Eng' },
                { data: 'status', name: 'name' , title: 'Status' },
                { data: 'level', name: 'name' , title: 'Level' },
                { data: 'keterangan', name: 'keterangan' , title: 'Keterangan' },
                { data: 'action', name: 'action' , title: 'Action' }
            ]
    });
    
    }

    $(function() {


        view(); //call datatable view

        /* Edit Data */
        $("#datatable").on("click", "tr #edit", function() { 
             $("input").val(""); 
             $('#summernote').summernote('destroy');

            $("#program_id").val($(this).data('id'));
            $("select#kategori_id").val($(this).data('kategori'));
            $("#program_name").val($(this).data('nama'));
            $("#program_code").val($(this).data('code'));
            $("#status").val($(this).data('status'));
            $("#program_sing_eng").val($(this).data('sing_int'));
            $("#program_sing_ind").val($(this).data('sing_ind'));
            $("#program_harga").val($(this).data('harga'));
           
            $("select#level").val($(this).data('level'));
            $('.kt-selectpicker').selectpicker('refresh');
           
            $.ajax({
            type: "post",
            url: "{{ route('mgt.cbt.program.desc') }}",
            dataType:"json",
            data: {
                id: $(this).data('id'),
            },
            beforeSend: function() {
                KTApp.blockPage();
                },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                
                if(response.status === 200) {
                   
                    $('.summernote').summernote('code', response.data);
                    setTimeout(function() {
                        KTApp.unblockPage(); //loading icon
                    }, 2000);
                    $('#add').modal('show');
                    
                } else if(response.status === 500) {
                    // do something with response.message or whatever other data on error
                }
            }
        })

           
        });

        $("#datatable").on("click", "tr #hapus", function(event) {
     
            data = $(this).data('id');
            table = $('#datatable').DataTable().destroy();

        $.ajax({
            type: "post",
            url: "{{ route('mgt.cbt.program.delete') }}",
            dataType:"json",
            data: {
                id: data,
            },
            beforeSend: function() {
                KTApp.blockPage();
                },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                //  alert(JSON.stringify(response));
                if(response.status === 200) {
                    view();
                    setTimeout(function() {
                        KTApp.unblockPage(); //loading icon
                    }, 2000);
                    
                } else if(response.status === 500) {
                    // do something with response.message or whatever other data on error
                }
            }
        })
        return false;
        event.preventDefault();
        });

        /* New Data Button */
        $('#new').click(function(event) {
            $("input").val("");
            $('.summernote').summernote('reset');
            $("select#kategori_id").val("");
            $('.kt-selectpicker').selectpicker('refresh');
        });

        /* Simpan Data */
        $('#simpan').click(function(event) {
            if($("form")[0].checkValidity()) {
               alert("error");
               console.log("error");
               
        }else {
            console.log("invalid form");
        }
            // table = $('#datatable').DataTable().destroy();
           
            // $.ajax({
            //     type: "post",
            //     url: "{{ route('mgt.cbt.program.insert') }}",
            //     dataType:"json",
            //     data: {
            //         id: $("#program_id").val(),
            //         program_type_id: $("#kategori_id").val(),
            //         code: $("#program_code").val(),
            //         name: $("#program_name").val(),
            //         sing_ind: $("#program_sing_ind").val(),
            //         sing_int: $("#program_sing_eng").val(),
            //         level: $("#level").val(),
            //         harga: $("#program_harga").val(),
            //         status: $("#status").val(),
            //         desc: $(".note-editable").html(),
            //     },
            //     beforeSend: function() {
            //         KTApp.block('#add .modal-content', {
            //         overlayColor: '#000000',
            //         type: 'v2',
            //         state: 'primary',
            //         message: 'Processing...'
            //     });
            //     },
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     },
            //     success: function (response) {
            //         // alert(JSON.stringify(response));
            //         if(response.status === 200) {
            //             view();
            //             setTimeout(function() {
            //                 KTApp.unblock('#add .modal-content');
            //                 $('#add').modal('hide');
            //             }, 2000);
                        
            // //          
            //         } else if(response.status === 500) {
            //             // do something with response.message or whatever other data on error
            //         }
            //     }
            // })
            // return false;
            // event.preventDefault();
        });

   
    });
    
</script>   
   
@endpush
