<?php $__env->startSection('content'); ?>

    <!-- begin:: Content -->
    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">


        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon-presentation"></i>
										</span>
                    <h3 class="kt-portlet__head-title">
                        Data Assessor : <?php echo e($assessor->name); ?>

                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                <?php echo $__env->make('flash::message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <table class="table table-bordered">
                    <tr>
                        <td width="25%">
                            <img src="<?php echo Storage::url('upload/backend/assessor/'.$assessor->id.'/'.$assessor->foto); ?>" alt="<?php echo e($assessor->name); ?>" width="400" class="img-responsive kt-userpic kt-margin-r-5 kt-margin-t-5">
                        </td>
                        <td>
                            <table class="table table-bordered">
                                <tr>
                                    <td width="15%">Email</td>
                                    <td width="5">:</td>
                                    <td><?php echo e($assessor->email); ?></td>
                                </tr>
                                <tr>
                                    <td>Mobile Phone</td>
                                    <td>:</td>
                                    <td><?php echo e($assessor->mobile_phone); ?></td>
                                </tr>
                                <tr>
                                    <td>Instansi</td>
                                    <td>:</td>
                                    <td><?php echo e($assessor->company); ?></td>
                                </tr>
                                <tr>
                                    <td>Posisi/Jabatan</td>
                                    <td>:</td>
                                    <td><?php echo e($assessor->position); ?></td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td>:</td>
                                    <td><?php echo e(($assessor->status) ? 'Aktif':'Tidak Aktif'); ?></td>
                                </tr>
                                <tr>
                                    <td>Profil</td>
                                    <td>:</td>
                                    <td><?php echo $assessor->profile; ?></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <!-- end:: Content -->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.modal.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/DataMaster/AssessorController/show.blade.php ENDPATH**/ ?>