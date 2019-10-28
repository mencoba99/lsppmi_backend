<?php if(count($errors) > 0): ?>
    <div class="alert alert-danger">
        <div class="alert-text">
            <h4>Maaf, terjadi kesalahan</h4>
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo $error; ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
            <hr>
            <p class="mb-0">
                Harap cek kembali form, pastikan isian form sudah terisi dan sesuai.
            </p>
        </div>

        <div class="alert-close">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="la la-close"></i></span>
            </button>
        </div>
    </div>
<?php endif; ?>
<?php /**PATH /var/www/resources/views/errors/list.blade.php ENDPATH**/ ?>