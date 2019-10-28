<?php $__currentLoopData = session('flash_notification', collect())->toArray(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if($message['overlay']): ?>
        <?php echo $__env->make('flash::modal', [
            'modalClass' => 'flash-modal',
            'title'      => $message['title'],
            'body'       => $message['message']
        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php else: ?>
        <div class="alert
                    alert-<?php echo e($message['level']); ?>

                    <?php echo e($message['important'] ? 'alert-important' : ''); ?>"
                    role="alert"
        >
            <?php if($message['important']): ?>
                <div class="alert-close">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true"><i class="la la-close"></i></span>
                    </button>
                </div>
            <?php endif; ?>

            <div class="alert-text">
                <?php if($message['level'] == 'danger'): ?>
                    <h4>Maaf, terjadi kesalahan</h4>
                <?php elseif($message['level'] == 'success'): ?>
                    <h4>Sukses</h4>
                <?php elseif($message['level'] == 'info'): ?>
                    <h4>Informasi</h4>
                <?php elseif($message['level'] == 'warning'): ?>
                    <h4>Perhatian!</h4>
                <?php endif; ?>
                <?php echo $message['message']; ?>

            </div>
        </div>
    <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php echo e(session()->forget('flash_notification')); ?>



<?php echo $__env->make('errors.list', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH /var/www/resources/views/vendor/flash/message.blade.php ENDPATH**/ ?>