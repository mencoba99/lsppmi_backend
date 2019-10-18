@extends('layouts.base')

@section('content')

<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
    <div class="alert alert-light alert-elevate" role="alert">
        <div class="alert-icon"><i class="flaticon-warning kt-font-brand"></i></div>
        <div class="alert-text">
            Ini adalah menu data provinsi.
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
                    Provinsi
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
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Data Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form id="form-provinsi">
                    <div class="form-group">
                        <label for="recipient-name" class="form-control-label">Nama Provinsi:</label>
                        <input type="text" class="form-control" name="nm_provinsi[]" id="provinsi_nm">
                        <input type="text" class="form-control " style="display:none" name="id_provinsi[]" id="provinsi_id">
                    </div>
                    
                </form>
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
  function view(){
    $('#datatable').DataTable().destroy();
    $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('master.provinsi.data') }}",
            columns: [
                { data: 'id', render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                } , title: 'No.' },
                { data: 'nm_provinsi', name: 'nm_provinsi' , title: 'Nama Provinsi' },
                { data: 'created_at', name: 'created_at' , title: 'Created At' },
                { data: 'updated_at', name: 'updated_at' , title: 'Update At' },
                { data: 'action', name: 'action' , title: 'Action' }
            ]
        });

        

  }
    $(function() {
       

        view();     
    $("#datatable").on("click", "tr #edit", function() {  
        data = $(this).data('id');
        nama = $(this).data('nama');
        $("#provinsi_id").val(data);
        $("#provinsi_nm").val(nama);
        $('#add').modal('show');


    });

    $("#datatable").on("click", "tr #hapus", function() {
     
     data = $(this).data('id');
     table = $('#datatable').DataTable().destroy();

     $.ajax({
         type: "post",
         url: "{{ route('master.provinsi.delete') }}",
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
                    KTApp.unblockPage();
                }, 2000);
                
             } else if(response.status === 500) {
                 // do something with response.message or whatever other data on error
             }
         }
     })
     return false;
     event.preventDefault();
    });

    $('#new').click(function(event) {
        $("input").val("");
    });

    $('#simpan').click(function(event) {
        
        dataString = $("#form-provinsi").serialize();
        data = $("#provinsi_nm").val();
        id = $("#provinsi_id").val();
       
        table = $('#datatable').DataTable().destroy();
        

        $.ajax({
            type: "post",
            url: "{{ route('master.provinsi.insert') }}",
            dataType:"json",
            data: {
                nm_provinsi: data,
                id_provinsi: id,
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