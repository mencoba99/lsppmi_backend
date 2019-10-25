@extends('layouts.base')

@section('content')

<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
    <div class="alert alert-light alert-elevate" role="alert">
        <div class="alert-icon"><i class="flaticon-warning kt-font-brand"></i></div>
        <div class="alert-text">
            Ini adalah menu data kota.
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
                    Kota
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
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Data Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                    <form class="kt-form kt-form--label-right">
                            <div class="kt-portlet__body">
                                <div class="kt-section kt-section--first">
                                    
                                    <div class="kt-section__body">
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label">Nama Kota:</label>
                                            <div class="col-lg-6">
                                                {!! Form::text('kota_nm',null,['id'=>'kota_nm','class'=>'form-control ','required'=>'required']) !!}
                                                {!! Form::text('kota_id',null,['id'=>'kota_id','class'=>'form-control','hidden'=>'hidden']) !!}
                                               <span class="form-text text-muted">Silahkan tulis nama kota yang akan diinput.</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Kode Pos:</label>
                                                <div class="col-lg-6">
                                                    {!! Form::text('pos_kd',null,['id'=>'pos_kd','class'=>'form-control ','required'=>'required']) !!}
                                                   <span class="form-text text-muted">Silahkan tulis kode pos yang akan diinput.</span>
                                                </div>
                                            </div>
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label">Provinsi:</label>
                                            <div class="col-lg-6">
                                                    {!! Form::select('id_provinsi',$provinsi,null,['id'=>'id_provinsi','class'=>'form-control input-sm kt-selectpicker','required'=>'required','data-live-search'=>"true",'placeholder'=>'Pilih Provinsi']) !!}
                                                    
                                                <span class="form-text text-muted">Silahkan ketik dan pilih.</span>
                                            </div>
                                        </div>	
                                    </div>
            
                                    <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>
            
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
            ajax: "{{ route('master.kota.data') }}",
            columns: [
                { data: 'id', render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                } , title: 'No.' },
                { data: 'nm_kota', name: 'nm_kota' , title: 'Nama Kota' },
                { data: 'provinsi.nm_provinsi', name: 'nm_provinsi' , title: 'Nama Provinsi' },
                { data: 'kode_pos', name: 'kode_pos' , title: 'Kode Pos' },
                { data: 'action', name: 'action' , title: 'Action' }
            ]
    });
    }

    $(function() {


        view(); //call datatable view

        // $("#provinsi").select2({
        //     placeholder: "Search for provinsi",
        //     dropdownParent: "#add",
        //     allowClear: true,
        //     ajax: {
        //         url: "{{ route('master.provinsi.json') }}",
        //         dataType: 'json',
        //         delay: 250,
        //         data: function(params) {
        //             // console.log(JSON.stringify(params));
        //             return {
        //                 q: params.nm_provinsi, // search term
        //                 page: params.nm_provinsi
        //             };
        //         },
        //         processResults: function(data, params) {
        //             // parse the results into the format expected by Select2
        //             // since we are using custom formatting functions we do not need to
        //             // alter the remote JSON data, except to indicate that infinite
        //             // scrolling can be used
                    
        //             params.page = params.page || 1;
                        
        //                 var resData = [];
        //                 data.forEach(function(value) {
        //                         if (value.nm_provinsi.indexOf(params.term) != -1)
        //                             resData.push(value)
        //                     })
                            
        //                     return {
        //                     results: $.map(resData, function(item) {
        //                         return {
        //                             text: item.nm_provinsi,
        //                             id: item.Id
        //                         }
        //                     })
        //                     };
        //         },
        //         cache: true
        //     },
        //     escapeMarkup: function(markup) {
        //         return markup;
        //     }, // let our custom formatter work
        //     minimumInputLength: 1,
            
            
        // });

        /* Edit Data */
        $("#datatable").on("click", "tr #edit", function() { 
             $("input").val(""); 
            data = $(this).data('id');
            nama = $(this).data('nama');
            kode_pos = $(this).data('kode');
            provinsi = $(this).data('provinsi');
            $("#kota_id").val(data);
            $("#kota_nm").val(nama);
            $("#pos_kd").val(kode_pos);
            $("select#id_provinsi").val(provinsi);
            $('.kt-selectpicker').selectpicker('refresh');
            $('#add').modal('show');
        });

        $("#datatable").on("click", "tr #hapus", function() {
     
            data = $(this).data('id');
            table = $('#datatable').DataTable().destroy();

        $.ajax({
            type: "post",
            url: "{{ route('master.kota.delete') }}",
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
        
            // dataString = $("#form-kota").serialize();
            // data = $("#kota_nm").val();
            // id = $("#kota_id").val();
            // pos = $("#pos_kd").val();
            // provinsi = $("#id_provinsi").val();
           
            table = $('#datatable').DataTable().destroy();
        

            $.ajax({
                type: "post",
                url: "{{ route('master.kota.insert') }}",
                dataType:"json",
                data: {
                    nm_kota: $("#kota_nm").val(),
                    id_kota: $("#kota_id").val(),
                    pos_kd: $("#pos_kd").val(),
                    id_provinsi: $("#id_provinsi").val(),
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
