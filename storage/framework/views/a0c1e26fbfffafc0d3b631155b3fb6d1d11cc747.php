<?php $__env->startSection('content'); ?>

<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
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
                                            <label class="col-lg-3 col-form-label">Modul:</label>
                                            <div class="col-lg-6">
                                                    <?php echo Form::select('modul_id',$modul,null,['id'=>'modul_id','class'=>'form-control input-sm kt-selectpicker','required'=>'required','data-live-search'=>"true",'placeholder'=>'Pilih Modul']); ?>

                                                    <?php echo Form::text('soal_id',null,['id'=>'soal_id','class'=>'form-control','hidden'=>'hidden']); ?>

                                               
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Submodul:</label>
                                                <div class="col-lg-6">
                                                    <?php echo Form::select('submodul_id',['' => ''],null,['id'=>'submodul_id','class'=>'form-control input-sm kt-selectpicker','required'=>'required','data-live-search'=>"true"]); ?>

                                              
                                                </div>
                                        </div>
                                        <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Bobot:</label>
                                                <div class="col-lg-6">
                                                    <?php echo Form::select('jenissoal_id',$bobot,null,['id'=>'jenissoal_id','class'=>'form-control input-sm kt-selectpicker','required'=>'required','data-live-search'=>"true",'placeholder'=>'Pilih Bobot']); ?>

                                                </div>
                                        </div>
                                        <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Parent:</label>
                                                <div class="col-lg-6">
                                                    <?php echo Form::select('parent_id',['' => 'Parent'],null,['id'=>'parent_id','class'=>'form-control input-sm kt-selectpicker','data-live-search'=>"true"]); ?>

                                                </div>
                                        </div>
                                        <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Nick:</label>
                                                <div class="col-lg-6">
                                                    <?php echo Form::text('nick',null,['id'=>'nick','class'=>'form-control ','required'=>'required']); ?>

                                                 
                                                </div>
                                        </div>
                                        <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">soal:</label>
                                                <div class="col-lg-6">
                                                    <?php echo Form::textarea('soal',null,['id'=>'soal','class'=>'form-control summernote']); ?>

                                                  
                                                </div>
                                        </div>
                                        <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">a:</label>
                                                <div class="col-lg-6">
                                                    <?php echo Form::textarea('answer_a',null,['id'=>'answer_a','class'=>'form-control ','required'=>'required']); ?>

                                                  
                                                </div>
                                        </div>
                                        <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">b:</label>
                                                <div class="col-lg-6">
                                                    <?php echo Form::textarea('answer_b',null,['id'=>'answer_b','class'=>'form-control ','required'=>'required']); ?>

                                                  
                                                </div>
                                        </div>
                                        <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">c:</label>
                                                <div class="col-lg-6">
                                                    <?php echo Form::textarea('answer_c',null,['id'=>'answer_c','class'=>'form-control ','required'=>'required']); ?>

                                                  
                                                </div>
                                        </div>
                                        <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">d:</label>
                                                <div class="col-lg-6">
                                                    <?php echo Form::textarea('answer_d',null,['id'=>'answer_d','class'=>'form-control ','required'=>'required']); ?>

                                                  
                                                </div>
                                        </div>
                                        <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">e:</label>
                                                <div class="col-lg-6">
                                                    <?php echo Form::textarea('answer_e',null,['id'=>'answer_e','class'=>'form-control ','required'=>'required']); ?>

                                                  
                                                </div>
                                        </div>
                                        <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Tag:</label>
                                                <div class="col-lg-6">
                                                    <?php echo Form::text('tag',null,['id'=>'tag','class'=>'form-control ','required'=>'required']); ?>

                                                 
                                                </div>
                                        </div>
                                        <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Penjelasan:</label>
                                                <div class="col-lg-6">
                                                    <?php echo Form::textarea('desc',null,['id'=>'desc','class'=>'form-control ','required'=>'required']); ?>

                                                  
                                                </div>
                                        </div>
                                        <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Jawaban:</label>
                                                <div class="col-lg-6">
                                                    <?php echo Form::select('answer',['1' => 'a','2' => 'b','3' => 'c','4' => 'd','5' => 'e'],null,['id'=>'answer','class'=>'form-control input-sm kt-selectpicker','required'=>'required','data-live-search'=>"true",'placeholder'=>'Pilih Jawaban']); ?>

                                                  
                                                </div>
                                            </div>
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label">Status:</label>
                                            <div class="col-lg-6">
                                                <?php echo Form::select('status',$status,null,['id'=>'status','class'=>'form-control input-sm kt-selectpicker','required'=>'required','data-live-search'=>"true",'placeholder'=>'Pilih Status']); ?>

                                              
                                            </div>
                                        </div>
                                    </div>
            
                                </div>
                            </div>
                            
                       
               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" id="simpan" class="btn btn-brand btn-elevate btn-icon-sm">Simpan</button>
            </div>
        </form>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('style'); ?>
<style>
        tfoot {
             display: table-header-group;
        }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
  
<script type="text/javascript">
    var KTBootstrapSelect = function () {
    
    // Private functions
    var demos = function () {
        $('.kt-selectpicker').selectpicker().change(function(){
            $(this).valid()
        });

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
    form = $("#form").validate({
        rules: {
            "modul_id": {
                required: true
            },
            "submodul_id": {
                required: true,
                maxlength: 2
            },
            "jenissoal_id": {
                required: true
            },
            "nick": {
                required: true
            },
            "answer_a": {
                required: true
            },
            "answer_b": {
                required: true
            },
            "answer_c": {
                required: true
            },
            "answer_d": {
                required: true
            },
            "answer_e": {
                required: true
            },
            "tag": {
                required: true
            },
            "desc": {
                required: true
            },
            "answer": {
                required: true
            },
            "status": {
                required: true
            }

        },
        messages: {
            "modul_id": {
                required: "Silahkan pilih modul"
            },
            "submodul_id": {
                required: "Silahkan pilih submodul"
            },
            "jenissoal_id": {
                required: "Silahkan pilih bobot"
            },
            "nick": {
                required: "Silahkan tulis nick"
            },
            "answer_a": {
                required: "Silahkan tulis jawaban "
            },
            "answer_b": {
                required: "Silahkan tulis jawaban "
            },
            "answer_c": {
                required: "Silahkan tulis jawaban "
            },
            "answer_d": {
                required: "Silahkan tulis jawaban "
            },
            "answer_e": {
                required: "Silahkan tulis jawaban "
            },
            "tag": {
                required: "Silahkan tulis tag"
            },
            "desc": {
                required: "Silahkan tulis penjelasan"
            },
            "answer": {
                required: "Silahkan pilih jawaban"
            },
            "status": {
                required: "Silahkan pilih status"
            }
        },
        submitHandler: function (form) { 
            table = $('#datatable').DataTable().destroy();
           
            $.ajax({
                type: "post",
                url: "<?php echo e(route('materi.pembuatan-soal.insert')); ?>",
                dataType:"json",
                data: {
                    modul_id: $("#modul_id").val(),
                    id: $("#soal_id").val(),
                    soal: $("#soal").val(),
                    submodul: $("#submodul_id").val(),
                    bobot: $("#jenissoal_id").val(),
                    nick: $("#nick").val(),
                    answer_a: $("#answer_a").val(),
                    answer_b: $("#answer_b").val(),
                    answer_c: $("#answer_c").val(),
                    answer_d: $("#answer_d").val(),
                    answer_e: $("#answer_e").val(),
                    tag: $("#tag").val(),
                    answer: $("#answer").val(),
                    status: $("#status").val(),
                    desc: $("#desc").val(),
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
            ajax: "<?php echo e(route('materi.pembuatan-soal.data')); ?>",
            columns: [
                { data: 'soal_id', render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                } , title: 'No.', width : "3%" },
                { data: 'nick', name: 'nick' , title: 'Nick' },
                { data: 'bobot', name: 'bobot' , title: 'Jenis Soal' },
                { data: 'hit', name: 'hit' , title: 'Hit' },
                { data: 'modul', name: 'modul' , title: 'Modul' },
                { data: 'submodul', name: 'submodul' , title: 'Submodul' },
                { data: 'soal_id', name: 'soal_id' , title: 'ID' },
                { data: 'status', name: 'status' , title: 'Status', width : "10%" },
                { data: 'action', name: 'action' , title: 'Action', width : "5%" }
            ],
            initComplete: function () {
            this.api().columns([4,5]).every( function () {
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

    $(function () {

        view(); //call datatable view

        /* Edit Data */
        $("#datatable").on("click", "tr #edit", function () {
            $("input").val("");
            form.resetForm();
            $("#soal_id").val($(this).data('id'));
            $("#modul_id").val($(this).data('modul'));

            $("#soal").val($(this).data('soal'));
            $("#submodul_id").val($(this).data('submodul'));
            $("#jenissoal_id").val($(this).data('bobot'));
            $("#nick").val($(this).data('nick'));
            $("#answer_a").val($(this).data('a'));
            $("#answer_b").val($(this).data('b'));
            $("#answer_c").val($(this).data('c'));
            $("#answer_d").val($(this).data('d'));
            $("#answer_e").val($(this).data('e'));
            $("#tag").val($(this).data('tag'));
            $("#answer").val($(this).data('jawaban'));
            $("#status").val($(this).data('status'));
            $("#desc").val($(this).data('desc'));
            $('.summernote').summernote('code', $(this).data('desc'));
            $('.kt-selectpicker').selectpicker('refresh');

            $('#add').modal('show');
        });

        /* New Data Button */
        $('#new').click(function (event) {
            $("input").val("");
            $("select#status").val("");
            $('.kt-selectpicker').selectpicker('refresh');
            form.resetForm();
        });

        $('select#modul_id').on('change', function () {

            $.ajax({
                type: "POST",
                url: "<?php echo e(route('materi.pembuatan-soal.modul')); ?>",
                data: {
                    'id_modul': this.value
                },
                beforeSend: function () {
                    KTApp.block();
                    $('select#submodul_id').html("");
                    $('.kt-selectpicker').selectpicker('refresh');
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {

                    $.each(data, function (index, value) {
                        KTApp.unblock();
                        $('select#submodul_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                        $('.kt-selectpicker').selectpicker('refresh');
                    });

                }
            });

        });



    });
    
</script>   
   
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/management/cbt/materi/soal.blade.php ENDPATH**/ ?>