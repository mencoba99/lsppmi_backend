<?php $__env->startSection('content'); ?>

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
                </tr>
                </thead>
                <tfoot>
                <tr>
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
                                            <label class="col-lg-3 col-form-label">Nama Kota:</label>
                                            <div class="col-lg-6">
                                                <?php echo Form::text('kota_nm',null,['id'=>'kota_nm','class'=>'form-control ','required'=>'required']); ?>

                                                <?php echo Form::text('kota_id',null,['id'=>'kota_id','class'=>'form-control','hidden'=>'hidden']); ?>

                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label">Provinsi:</label>
                                            <div class="col-lg-6">
                                                    <?php echo Form::select('id_provinsi',$provinsi,null,['id'=>'id_provinsi','class'=>'form-control input-sm kt-selectpicker','required'=>'required','data-live-search'=>"true",'placeholder'=>'Pilih Provinsi']); ?>

                                                
                                            </div>
                                        </div>	
                                    </div>
            
                                    <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>
            
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

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
  
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
            "kota_nm": {
                required: true
            },
            "id_provinsi": {
                required: true
            }

        },
        messages: {
            "kota_nm": {
                required: "Silahkan tulis nama kota yang akan diinput"
            },
            "id_provinsi": {
                required: "Silahkan pilih provinsi"
            }
        },
        submitHandler: function (form) { // for demo
            table = $('#datatable').DataTable().destroy();
        

        $.ajax({
            type: "post",
            url: "<?php echo e(route('master.kota.insert')); ?>",
            dataType:"json",
            data: {
                nm_kota: $("#kota_nm").val(),
                id_kota: $("#kota_id").val(),
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
        }
    });
});

  function view(){
    $('#datatable').DataTable().destroy(); // destroy datatable
    /* Datatable View */
    $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "<?php echo e(route('master.kota.data')); ?>",
            columns: [
                { data: 'id', render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                } , title: 'No.' , width : "3%"},
                { data: 'name', name: 'name' , title: 'Nama Kota' },
                { data: 'provinsi.name', name: 'nm_provinsi' , title: 'Nama Provinsi' },
                { data: 'action', name: 'action' , title: 'Action', width : "5%" }
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
            kode_pos = $(this).data('kode');
            provinsi = $(this).data('provinsi');
            $("#kota_id").val(data);
            $("#kota_nm").val(nama);
            $("#pos_kd").val(kode_pos);
            $("select#id_provinsi").val(provinsi);
            $('.kt-selectpicker').selectpicker('refresh');
            $('#add').modal('show');
        });


        /* New Data Button */
        $('#new').click(function(event) {
            $("input").val("");
        });

       

   
    });
    
</script>   
   
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/master/kota.blade.php ENDPATH**/ ?>