<dialog id="buyCrypto" class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg">Buy Crypto</h3>
        <form action="<?php echo e(route("crypto.buy")); ?>" method="post" class="p-4">
            <?php echo csrf_field(); ?>
            <label>
                <select name="account_number" class="select select-bordered w-full mt-5 input-md">
                    <option disabled selected>Select the account which you'll use to purchase crypto</option>
                    <?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($account->account_number); ?>"><?php echo e($account->name); ?> (<?php echo e($account->account_number); ?>) - <?php echo e($account->balance); ?> <?php echo e($account->currency); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <label>
                    <input type="text" name="amount" placeholder="Amount you wish to purchase" class="input input-md input-bordered w-full mt-5" />
                </label>
            </label>
            <input type="hidden" name="crypto_id" value="">

            <button type="submit" class="btn btn-outline btn-accent w-full mt-5">Buy</button>

        </form>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>
<?php /**PATH C:\Users\Vilnis\test\InternetBank\resources\views/modals/buy-crypto.blade.php ENDPATH**/ ?>