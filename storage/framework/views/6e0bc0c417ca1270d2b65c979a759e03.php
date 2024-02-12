<dialog id="transferMoney" class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg">Transfer Money</h3>
        <form action="<?php echo e(route("accounts.transfer")); ?>" method="post" class="p-4">
            <?php echo csrf_field(); ?>
            <label>
                <select name="from_account" class="select select-bordered w-full mt-5 input-md">
                    <option disabled selected>Select account from which you'll transfer</option>
                    <?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($account->account_number); ?>"><?php echo e($account->name); ?> (<?php echo e($account->account_number); ?>) - <?php echo e($account->balance); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>

                <label>
                    <input type="text" name="to_account" placeholder="Account to which you'll transfer" class="input input-md input-bordered w-full mt-5" />
                </label>

                <label>
                    <input type="text" name="amount" placeholder="Amount" class="input input-md input-bordered w-full mt-5" />
                </label>
            </label>

            <button type="submit" class="btn btn-outline btn-accent w-full mt-5">Transfer</button>

        </form>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>
<?php /**PATH C:\Users\Vilnis\test\InternetBank\resources\views/modals/transfer-money.blade.php ENDPATH**/ ?>