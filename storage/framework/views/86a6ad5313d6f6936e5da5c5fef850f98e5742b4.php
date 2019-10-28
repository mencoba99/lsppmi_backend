<?php $__env->startSection('content'); ?>

<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
    <div class="alert alert-light alert-elevate" role="alert">
        <div class="alert-icon"><i class="flaticon-warning kt-font-brand"></i></div>
        <div class="alert-text">
            <?php echo e($Title); ?>

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
                  <?php echo e(ucfirst(trans(end($crumbs)))); ?>

                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        <button type="button" id="new" class="btn btn-brand btn-elevate btn-icon-sm" data-toggle="modal" data-target="#add"><i class="la la-plus"></i>
                            Tambah   <?php echo e(ucfirst(trans(end($crumbs)))); ?></button>
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
                <h5 class="modal-title" id="exampleModalLabel">Tambah  <?php echo e(ucfirst(trans(end($crumbs)))); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                    <form id="form" class="kt-form kt-form--label-right">
                            <div class="kt-portlet__body">
                                <div class="kt-section kt-section--first">
                                    
                                    <div class="kt-section__body">
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label">Program:</label>
                                            <div class="col-lg-6">
                                                <?php echo Form::select('program_id',$Program,null,['id'=>'program_id','class'=>'form-control input-sm kt-selectpicker','required'=>'required','data-live-search'=>"true",'placeholder'=>'Pilih Program']); ?>

                                                <?php echo Form::text('mgt_id',null,['id'=>'mgt_id','class'=>'form-control','hidden'=>'hidden']); ?>

                                               
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Modul:</label>
                                                <div class="col-lg-6">
                                                        <div id="tree">
                                                                <ul>
                                                        <?php $__currentLoopData = $modul; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data_modul): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <li id="<?php echo e($data_modul->id); ?>">
                                                                <?php echo e($data_modul->name); ?>

                                                                <ul>
                                                                <?php $__currentLoopData = $data_modul->submodul; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <li id="<?php echo e($item->id); ?>">
                                                                   <?php echo e($item->name); ?>

                                                                </li>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </ul>
                                                            </li>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </ul>
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

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
  
<script type="text/javascript">
    $(function () {
    $("#tree").jstree({
        "checkbox": {
            "keep_selected_style": false
        },
            "plugins": ["checkbox"]
    });
    $("#tree").bind("changed.jstree",
    function (e, data) {
        alert("Checked: " + data.node.id);
        alert("Parent: " + data.node.parent); 
        //alert(JSON.stringify(data));
    });


});

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

$(function () {
    KTBootstrapSelect.init();
    form = $("#form").validate({
        rules: {
            "program_id": {
                required: true
            },
            "tree": {
                required: true
            }

        },
        messages: {
            "program_id": {
                required: "Silahkan pilih program "
            },
            "tree": {
                required: "Silahkan tulis keterangan yang akan diinput"
            }
        },
        submitHandler: function (form) { // for demo
               table = $('#datatable').DataTable().destroy();
               checked_ids = []; 
                $("#tree").jstree("get_checked",null,true).each 
                    (function () { 
                        checked_ids.push(this.id); 
                    }); 
           doStuff(checked_ids); 

            $.ajax({
                type: "post",
                url: "<?php echo e(route('mgt.cbt.kategori.insert')); ?>",
                dataType:"json",
                data: {
                    program: $("#program_id").val(),
                    id: $("#mgt_id").val(),
                    modul: checked_ids,
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
                    alert(JSON.stringify(response));
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
            ajax: "<?php echo e(route('mgt.cbt.management.data')); ?>",
            columns: [
                { data: 'id', render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                } , title: 'No.', width : "3%" },
                { data: 'name', name: 'name' , title: 'Nama Kategori' },
                { data: 'programs.name', name: 'programs.name' , title: 'Modul ' },
                { data: 'modul.name', name: 'modul.name' , title: 'Modul' },
                { data: 'submodul.name', name: 'submodul.name' , title: 'SubModul' },
                { data: 'total_soal', name: 'total_soal' , title: 'Total Soal', width : "10%" },
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
            $("#status").val($(this).data('status'));
            $("#simpan").show();
           
            $('#add').modal('show');
        });

      

        /* New Data Button */
        $('#new').click(function(event) {
            $("input").val("");
            $("textarea").val("");
           
            form.resetForm();
            $("#simpan").show();
        });

    });
    
</script>   
   
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/management/cbt/MgtProgram.blade.php ENDPATH**/ ?>