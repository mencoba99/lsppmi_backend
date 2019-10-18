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
                            Tambah   {{ucfirst(trans(end($crumbs)))}}</button>
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
                </tr>
                </thead>
                <tfoot>
                <tr>
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
                <h5 class="modal-title" id="exampleModalLabel">Tambah  {{ucfirst(trans(end($crumbs)))}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                    <form class="kt-form kt-form--label-right">
                            <div class="kt-portlet__body">
                                <div class="kt-section kt-section--first">
                                    
                                    <div class="kt-section__body">
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label">Nama Modul:</label>
                                            <div class="col-lg-6">
                                                {!! Form::text('modul_nm',null,['id'=>'modul_nm','class'=>'form-control ','required'=>'required']) !!}
                                                {!! Form::text('modul_id',null,['id'=>'modul_id','class'=>'form-control','hidden'=>'hidden']) !!}
                                               <span class="form-text text-muted">Silahkan tulis nama modul yang akan diinput.</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Harga:</label>
                                                <div class="col-lg-6">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend"><span class="input-group-text" id="btnGroupAddon2">Rp.</span></div>
                                                            {!! Form::number('harga',null,['id'=>'harga','class'=>'form-control ','required'=>'required']) !!}
                                                        </div>
                                                        <span class="form-text text-muted">Silahkan tulis harga yang akan diinput.</span>
                                                </div>
                                        </div>
                                        <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Persentase Kelulusan:</label>
                                                <div class="col-lg-6">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend"><span class="input-group-text" id="btnGroupAddon2">Rp.</span></div>
                                                            {!! Form::number('persentase_kelulusan',null,['id'=>'persentase_kelulusan','class'=>'form-control ','required'=>'required']) !!}
                                                        </div>
                                                        <span class="form-text text-muted">Silahkan tulis persentase kelulusan yang akan diinput.</span>
                                                </div>
                                        </div>
                                        <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Singkatan Eng:</label>
                                                <div class="col-lg-6">
                                                    {!! Form::text('sing_eng',null,['id'=>'sing_eng','class'=>'form-control ','required'=>'required']) !!}
                                                   <span class="form-text text-muted">Silahkan tulis kode yang akan diinput.</span>
                                                </div>
                                        </div>
                                        <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Keterangan:</label>
                                                <div class="col-lg-6">
                                                    {!! Form::textarea('kategori_desc',null,['id'=>'kategori_desc','class'=>'form-control ','required'=>'required']) !!}
                                                   <span class="form-text text-muted">Silahkan tulis keterangan yang akan diinput.</span>
                                                </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label">Status:</label>
                                            <div class="col-lg-6">
                                                {!! Form::select('status',$status,null,['id'=>'status','class'=>'form-control input-sm kt-selectpicker','required'=>'required','data-live-search'=>"true",'placeholder'=>'Pilih Level']) !!}
                                               <span class="form-text text-muted">Silahkan tulis kode yang akan diinput.</span>
                                            </div>
                                    </div>
                                    </div>
            
                                </div>
                            </div>
                            
                        </form>
                {{-- <form id="form-provinsi">
                    <div class="form-group row">
                        <label for="recipient-name" class="form-control-label  col-lg-3 col-sm-12">Nama Provinsi:</label>
                        <input type="text" class="form-control" name="nm_provinsi[]" id="provinsi_nm">
                        <input type="text" class="form-control " style="display:none" name="id_provinsi[]" id="provinsi_id">
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3 col-sm-12">Remote Data:</label>
                        
                            <select class="form-control kt-select2" id="kt_select2_6" name="param">
                                <option></option>
                            </select>
                       
                    </div>
                </form> --}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="simpan" class="btn btn-primary">Simpan</button>
            </div>
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
});

  function view(){
    $('#datatable').DataTable().destroy(); // destroy datatable
    /* Datatable View */
    $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('mgt.cbt.kategori.data') }}",
            columns: [
                { data: 'id', render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                } , title: 'No.' },
                { data: 'code', name: 'code' , title: 'Kode ' },
                { data: 'name', name: 'name' , title: 'Nama Kategori' },
                { data: 'description', name: 'description' , title: 'Keterangan' },
                { data: 'action', name: 'action' , title: 'Action' }
            ]
    });
    }

    $(function() {


        view(); //call datatable view


        /* Edit Data */
        $("#datatable").on("click", "tr #edit", function() { 
             $("input").val(""); 
            data = $(this).data('id');
            nama = $(this).data('nama');
            desc = $(this).data('desc');
            code = $(this).data('code');
            $("#kategori_id").val(data);
            $("#kategori_code").val(code);
            $("#kategori_desc").val(desc);
            $("#kategori_nm").val(nama);
           
           
            $('#add').modal('show');
        });

        $("#datatable").on("click", "tr #hapus", function() {
     
            data = $(this).data('id');
            table = $('#datatable').DataTable().destroy();

        $.ajax({
            type: "post",
            url: "{{ route('mgt.cbt.kategori.delete') }}",
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
        });

        /* Simpan Data */
        $('#simpan').click(function(event) {
        
            table = $('#datatable').DataTable().destroy();
        

            $.ajax({
                type: "post",
                url: "{{ route('mgt.cbt.kategori.insert') }}",
                dataType:"json",
                data: {
                    name: $("#kategori_nm").val(),
                    id: $("#kategori_id").val(),
                    code: $("#kategori_code").val(),
                    desc: $("#kategori_desc").val(),
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
        });

   
    });
    
</script>   
   
@endpush
