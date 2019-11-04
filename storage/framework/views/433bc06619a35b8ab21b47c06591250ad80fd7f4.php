<?php $__env->startSection('content'); ?>

<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-tag"></i>
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
                <h5 class="modal-title" id="exampleModalLabel">Tambah <?php echo e(ucfirst(trans(end($crumbs)))); ?></h5>
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
                                        <?php echo Form::select('program_id',$Program,null,['id'=>'program_id','class'=>'form-control
                                        input-sm
                                        kt-selectpicker','required'=>'required','data-live-search'=>"true"]); ?>

                                        <?php echo Form::text('mgt_id',null,['id'=>'mgt_id','class'=>'form-control','hidden'=>'hidden']); ?>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Modul:</label>
                                    <div class="col-lg-6">
                                        <div class='tree'>
                                            <ul>
                                                <?php $__currentLoopData = $modul; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $moduls): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li dataid=""><?php echo e($moduls->name); ?>

                                                    <ul>
                                                        <?php $__currentLoopData = $moduls->submodul; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $submoduls): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <li class="no_checkbox" dataid="<?php echo e($submoduls->id); ?>">
                                                            <?php echo e($submoduls->name); ?></li>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </ul>
                                                </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        </div>
                                        <input type="text" name="checktree" style="display:none" id="checktree"
                                            value="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Status:</label>
                                        <div class="col-lg-6">
                                            <?php echo Form::select('status', $status,null,['id'=>'status','class'=>'form-control input-sm kt-selectpicker','required'=>'required','data-live-search'=>"true"]); ?>

                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" id="simpan" class=" btn btn-brand btn-elevate btn-icon-sm">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
  
<script type="text/javascript">
     function getAllSelectedNodesText(jsTree) {
         // this returns ids of all selected nodes
         var selectedNodes = jsTree.jstree("get_selected");
         var allText = [];
         // Go through all selected nodes to get text
         $.each(selectedNodes, function (i, nodeId) {
             var node = jsTree.jstree("get_node", nodeId);
             allText.push(node.li_attr.dataid); // Add id modul to array
         });
         return allText; // This will join all entries with comma
     }

     var KTBootstrapSelect = function () {

         // Private functions
         var demos = function () {
             $('.kt-selectpicker').selectpicker().change(function () {
                 $(this).valid()
             });

             $('.tree').jstree({
                 "core": {
                     "dblclick_toggle": false,
                 },
                 "plugins": ["wholerow", "checkbox"],
             });

             $(".tree").click(function (jsTree) {
                 var allSelectedText = getAllSelectedNodesText($(".tree"));
                 console.log(allSelectedText);
                 $('#checktree').val(allSelectedText);
                 $('#checktree').valid();
                 

             });

            //  $(".tree").jstree({
            //      "checkbox": {
            //          "keep_selected_style": true
            //      },
            //      "plugins": ["checkbox", "sort"]
            //  });

            
         }

         return {
             // public functions
             init: function () {
                 demos();
             }
         };
     }();

jQuery(document).ready(function() {
    KTBootstrapSelect.init();
    form = $("#form").validate({
        rules: {
            "program_id": {
                required: true
            },
            "checktree": {
                required: true
            },
            "status": {
                required: true
            }

        },
        messages: {
            "program_id": {
                required: "Silahkan tulis nama kategori yang akan diinput "
            },
            "checktree": {
                required: "Silahkan pilih modul & submodul "
            },
            "status": {
                required: "Silahkan pilih modul & submodul "
            }
        },
        submitHandler: function (form) { // for demo
               table = $('#datatable').DataTable().destroy();
            

                $.ajax({
                type: "post",
                url: "<?php echo e(route('ujian-komputer.management.insert')); ?>",
                dataType:"json",
                data: {
                    checktree: $("#checktree").val(),
                    program: $("#program_id").val(),
                    status: $("#status").val(),
                    id: $("#mgt_id").val()
                },
                beforeSend: function() {
                //     KTApp.block('#add .modal-content', {
                //     overlayColor: '#000000',
                //     type: 'v2',
                //     state: 'primary',
                //     message: 'Processing...'
                // });
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
                            $.notify({
                                // options
                                message: 'Berhasil disimpan' 
                            },{
                                // settings
                                type: 'success',
                                placement: {
                                    from: "top",
                                    align: "right"
                                }
                            });
                        }, 2000);
                        
            //          
                    } else if(response.status === 500) {
                        $.notify({
                                // options
                                message: 'Error' 
                            },{
                                // settings
                                type: 'danger',
                                placement: {
                                    from: "top",
                                    align: "right"
                                }
                            });
                    }
                },error: function (jqXHR, exception) {
                    
                    msg = '';
                   if (jqXHR.status === 0) {
                       msg = 'Not connect.\n Verify Network.';
                   } else if (jqXHR.status == 404) {
                       msg = 'Requested page not found. [404]';
                   } else if (jqXHR.status == 500) {
                       msg = 'Internal Server Error [500].';
                   } else if (exception === 'parsererror') {
                       msg = 'Requested JSON parse failed.';
                   } else if (exception === 'timeout') {
                       msg = 'Time out error.';
                   } else if (exception === 'abort') {
                       msg = 'Ajax request aborted.';
                   } else {
                       msg = 'Uncaught Error.\n' + jqXHR.responseText;
                   }

                           KTApp.unblock('#add .modal-content');
                           $('#add').modal('hide');

                           $.notify({
                               // options
                               message: msg 
                           },{
                               // settings
                               type: 'danger',
                               placement: {
                                   from: "top",
                                   align: "right"
                               }
                           });

               },
            })
            return false;

           
        // if((this).jstree(true).get_selected()){
        //     alert("Checked: " + data.node.id);
        //     alert("Parent: " + data.node.parent); 
        // }
        // alert("Checked: " + data.node.id);
        // alert("Parent: " + data.node.parent); 
       

            
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
            ajax: "<?php echo e(route('ujian-komputer.management.data')); ?>",
            columns: [
                { data: 'id', render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                } , title: 'No.', width : "3%" },
                { data: 'nama_program', name: 'nama_program' , title: 'Program ' },
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
            $("select#status").val($(this).data('status'));
            $('.kt-selectpicker').selectpicker('refresh');
            $("#simpan").show();
           
            $('#add').modal('show');
        });

      

        /* New Data Button */
        $('#new').click(function(event) {
            $("input").val("");
            $("textarea").val("");
            $("select").val("");
            $('.kt-selectpicker').selectpicker('refresh');
            form.resetForm();
            $("#simpan").show();
        });

        // $('#checktree').on('change', function () {
        //     alert("tes");
        // });

        $('select#modul').on('change', function () {
           
            $.ajax({
                type: "POST",
                url: "<?php echo e(route('ujian-komputer.management.modul')); ?>",
                data: {
                    'modul_id': this.value
                },
                beforeSend: function () {
                    KTApp.block();
                    $('select#submodul').html("");
                    $('.kt-selectpicker').selectpicker('refresh');
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                     
                    $.each(data, function (index, value) {
                       
                        $('select#submodul').append('<option value="' + value.id + '">' + value.name + '</option>');
                        $('.kt-selectpicker').selectpicker('refresh');
                    });

                }
            });

            });

    });
    
</script>   
   
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/management/cbt/mgtprogram.blade.php ENDPATH**/ ?>