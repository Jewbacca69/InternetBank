<script>
    document.addEventListener('DOMContentLoaded', function () {
        <?php if(session('error')): ?>
        Swal.fire({
            title: 'Error!',
            text: '<?php echo e(session('error')); ?>',
            icon: 'error',
            timer: 3000,
            timerProgressBar: true
        });
        <?php endif; ?>
    });

    document.addEventListener('DOMContentLoaded', function () {
        <?php if(session('success')): ?>
        Swal.fire({
            title: 'Success!',
            text: '<?php echo e(session('success')); ?>',
            icon: 'success',
            timer: 3000,
            timerProgressBar: true
        });
        <?php endif; ?>
    });

    document.addEventListener('DOMContentLoaded', function () {
        <?php if($errors->any()): ?>
        let errorMessage = '';
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            errorMessage += '<?php echo e($error); ?><br>';
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        Swal.fire({
            title: 'Validation Error',
            html: errorMessage,
            icon: 'error',
            timer: 3000,
            timerProgressBar: true,
            showConfirmButton: false
        });
        <?php endif; ?>
    });
</script>
<?php /**PATH C:\Users\Vilnis\test\InternetBank\resources\views/components/swal.blade.php ENDPATH**/ ?>