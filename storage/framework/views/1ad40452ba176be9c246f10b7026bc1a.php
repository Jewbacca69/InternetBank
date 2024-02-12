<dialog id="sellCrypto" class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg">Sell Crypto</h3>
        <form action="<?php echo e(route('crypto.sell')); ?>" method="post" class="p-4">
            <?php echo csrf_field(); ?>
            <label>
                <select name="crypto_account" class="select select-bordered w-full mt-5 input-md">
                    <option disabled selected>Select the account from which you'll sell crypto</option>
                    <?php $__currentLoopData = $portfolio; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cryptoAccount): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($cryptoAccount->crypto_id); ?>"><?php echo e($cryptoAccount->crypto_address); ?>) - <?php echo e($cryptoAccount->balance); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </label>
            <label>
                <select name="account_number" class="select select-bordered w-full mt-5 input-md">
                    <option disabled selected>Select the account to which the funds will go</option>
                    <?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($account->account_number); ?>"><?php echo e($account->name); ?> (<?php echo e($account->account_number); ?>) - <?php echo e($account->balance); ?> <?php echo e($account->currency); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </label>

            <label>
                <input type="text" name="amount" placeholder="Amount you wish to sell" class="input input-md input-bordered w-full mt-5" />
            </label>

            <button type="submit" class="btn btn-outline btn-accent w-full mt-5">Sell</button>
        </form>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>
<?php /**PATH G:\Projects\InternetBank\resources\views/modals/sell-crypto.blade.php ENDPATH**/ ?>