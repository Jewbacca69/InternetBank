<!-- resources/views/accounts/index.blade.php -->

 <!-- Assuming you have a layout file -->

<?php $__env->startSection('content'); ?>
    <h1>Your Bank Accounts</h1>

    <?php if($accounts && $accounts->count() > 0): ?>
        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>Currency</th>
                <th>Balance</th>
            </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($account->id); ?></td>
                    <td><?php echo e($account->currency); ?></td>
                    <td><?php echo e($account->balance); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No accounts found.</p>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\Projects\InternetBank\resources\views/accounts/index.blade.php ENDPATH**/ ?>