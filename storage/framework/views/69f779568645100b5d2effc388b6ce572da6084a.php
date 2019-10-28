<?php $__env->startSection('content'); ?>

    <!-- begin:: Content -->
    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">


        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-line-chart"></i>
										</span>
                    <h3 class="kt-portlet__head-title">
                        Manajemen Role Permission [ <?php echo e($role->name); ?> ]
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                <?php echo $__env->make('flash::message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="row">
                    <?php if($permissions && $permissions->count() > 0): ?>
                        <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-sm-6">
                                <div class="kt-portlet ">
                                    <div class="kt-portlet__head">
                                        <div class="kt-portlet__head-label">
                                            <h3 class="kt-portlet__head-title">
                                                <?php echo e($permission->name); ?>

                                            </h3>
                                        </div>
                                        <div class="kt-portlet__head-toolbar">
                                            <div class="kt-portlet__head-actions">
                                                <span class="kt-switch kt-switch--icon">
                                                    <label>
                                                        <input type="checkbox" data-url="<?php echo e(route('role.permission.store',['role'=>$role,'permission'=>$permission])); ?>" <?php echo ($permission->hasRole($role)) ? 'checked':''; ?> name="roleParent" class="roleParentChange roleList">
                                                        <span></span>
                                                    </label>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="kt-portlet__body roleList <?php echo ($permission->hasRole($role) == false) ? 'blocked':''; ?>">
                                        <?php if($permission->children && $permission->children->count() > 0): ?>
                                            <table class="table table-striped table-bordered table-hover table-condensed">
                                                <?php $__currentLoopData = $permission->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td width="40%"><?php echo e($child->name); ?></td>
                                                        <td align="center">
                                                            <span class="kt-switch kt-switch--icon">
                                                                <label>
                                                                    <input type="checkbox" <?php echo ($child->hasRole($role)) ? 'checked':''; ?> data-url="<?php echo e(route('role.permission.store',['role'=>$role,'permission'=>$child])); ?>" name="" class="roleChildrenChange">
                                                                    <span></span>
                                                                </label>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </table>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- end:: Content -->

<?php $__env->stopSection(); ?>

<?php $__env->startPush('modal-script'); ?>
    <script type="text/javascript">

        $(document).ready(function () {
            KTApp.block('.blocked', {
                // overlayColor: '#000000',
                state: 'primary',
                type: 'v2',
                size: 'lg',
                overlayCSS:  {
                    backgroundColor: '#000',
                    opacity:         0.3,
                    cursor:          'wait'
                },
                message: "BLOCKED"
            });

            $('.roleParentChange').on('change', function (e) {
                var _this = $(this);
                var link = $(this).data('url');

                var isChecked = $(this).is(':checked');
                KTApp.blockPage({
                    overlayColor: '#000000',
                    type: 'v2',
                    size: 'lg',
                    state: 'primary',
                    message: 'Processing...'
                });

                if (isChecked === true) {
                    $.post(link, {state:isChecked}, function (data) {
                        console.log(data.status);
                        KTApp.unblockPage();
                        if(data.status == true) {
                            var blocked = _this.closest('.kt-portlet').find('.roleList');
                            // console.log(blocked);

                            KTApp.unblock(blocked);
                            $.notify({
                                title: "Sukses:",
                                message: "Permission berhasil disimpan ke Role"
                            },{
                                type: 'success',
                                newest_on_top: true
                            });
                        } else {
                            $.notify({
                                title: "Gagal:",
                                message: "Permission gagal disimpan ke Role"
                            },{
                                type: 'danger',
                                newest_on_top: true
                            });
                            // _this.attr('checked',false);
                        }
                    },"json");
                } else {
                    swal.fire({
                        title: 'Hapus data?',
                        text: 'Apakah Anda yakin untuk hapus data ini ?',
                        type: 'warning',
                        allowOutsideClick: true,
                        showConfirmButton: true,
                        showCancelButton: true,
                        confirmButtonClass: 'btn-info',
                        cancelButtonClass: 'btn-danger',
                        // closeOnConfirm: true,
                        // closeOnCancel: true,
                        confirmButtonText: 'Ya',
                        cancelButtonText: 'Tidak',
                    }).then(function(result){
                        if (result.value) {
                            $.post(link, {state:isChecked}, function (data) {
                                KTApp.unblockPage();
                                if(data.status == true) {
                                    KTApp.unblockPage();
                                    var blocked = _this.closest('.kt-portlet').find('.roleList');
                                    // console.log(blocked);
                                    KTApp.block(blocked, {
                                        // overlayColor: '#000000',
                                        state: 'primary',
                                        type: 'v2',
                                        size: 'lg',
                                        overlayCSS:  {
                                            backgroundColor: '#000',
                                            opacity:         0.3,
                                            cursor:          'wait'
                                        },
                                        message: "BLOCKED"
                                    });
                                    $.notify({
                                        title: "Sukses:",
                                        message: "Permission berhasil dihapus dari Role"
                                    },{
                                        type: 'success',
                                        newest_on_top: true
                                    });
                                } else {
                                    $.notify({
                                        title: "Gagal:",
                                        message: "Permission gagal dihapus dari Role"
                                    },{
                                        type: 'danger',
                                        newest_on_top: true
                                    });
                                }
                            },"json");
                        }
                    });
                }
            });

            $('.roleChildrenChange').on('change', function (e) {
                var _this = $(this);
                var _link = $(this).data('url');

                var isChecked = $(this).is(':checked');
                KTApp.blockPage({
                    overlayColor: '#000000',
                    type: 'v2',
                    size: 'lg',
                    state: 'primary',
                    message: 'Processing...'
                });

                if (isChecked == true) {
                    $.post(_link, {state:isChecked}, function (data) {
                        KTApp.unblockPage();
                        if (data.status == true) {
                            $.notify({
                                title: "Sukses:",
                                message: "Permission berhasil disimpan ke Role"
                            },{
                                type: 'success',
                                newest_on_top: true
                            });
                        } else {
                            $.notify({
                                title: "Gagal:",
                                message: "Permission gagal disimpan ke Role"
                            },{
                                type: 'danger',
                                newest_on_top: true
                            });
                        }
                    }, 'json');
                } else {
                    swal.fire({
                        title: 'Hapus data?',
                        text: 'Apakah Anda yakin untuk hapus data ini ?',
                        type: 'warning',
                        allowOutsideClick: true,
                        showConfirmButton: true,
                        showCancelButton: true,
                        confirmButtonClass: 'btn-info',
                        cancelButtonClass: 'btn-danger',
                        // closeOnConfirm: true,
                        // closeOnCancel: true,
                        confirmButtonText: 'Ya',
                        cancelButtonText: 'Tidak',
                    }).then(function(result){
                        if (result.value) {
                            $.post(_link, {state:isChecked}, function (data) {
                                KTApp.unblockPage();
                                if(data.status == true) {
                                    KTApp.unblockPage();
                                    var blocked = _this.closest('.kt-portlet').find('.roleList');
                                    $.notify({
                                        title: "Sukses:",
                                        message: "Permission berhasil dihapus dari Role"
                                    },{
                                        type: 'success',
                                        newest_on_top: true
                                    });
                                } else {
                                    $.notify({
                                        title: "Gagal:",
                                        message: "Permission gagal dihapus dari Role"
                                    },{
                                        type: 'danger',
                                        newest_on_top: true
                                    });
                                }
                            },"json");
                        }
                    });
                }
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.modal.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/PengaturanAplikasi/RoleController/permission.blade.php ENDPATH**/ ?>