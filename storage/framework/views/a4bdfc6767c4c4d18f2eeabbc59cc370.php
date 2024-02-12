<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            👋 Welcome, <?php echo e(Auth::user()->name); ?>!
        </h2>
     <?php $__env->endSlot(); ?>
    <?php echo $__env->make('components.swal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('modals.create-account', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('modals.transfer-money', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="container mx-auto py-8 flex">
        <div class="card w-3/5 bg-base-700 shadow-lg">
            <div class="card-body">
                <h2 class="card-title text-lg font-semibold mb-4">Your Accounts
                    <span class="float-right">
                        <button onclick="createAccount.showModal()" class="btn btn-outline btn-sm btn-accent">Create Account</button>
                        <button onclick="transferMoney.showModal()" class="btn btn-outline btn-sm btn-accent">Transfer Money</button>
                    </span>
                </h2>

                <div class="overflow-x-auto">
                    <table class="table-auto min-w-full bg-base-800 rounded-lg overflow-hidden">
                        <thead class="bg-base-700 text-white">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Type</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider w-0.5">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Account Number</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Balance</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Currency</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-600">
                        <?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <?php if($account->type == 'Investment'): ?>
                                        <div class="badge badge-accent badge-outline">Investment</div>
                                    <?php elseif($account->type == 'Debit'): ?>
                                        <div class="badge badge-primary badge-outline">Debit</div>
                                    <?php else: ?>
                                        <div class="badge badge-primary badge-outline">Unknown</div>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap"><?php echo e($account->name); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap"><?php echo e($account->account_number); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap"><?php echo e($account->currency); ?> <?php echo e($account->balance); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap"><?php echo e($account->currency); ?></td>

                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                    <?php if(count($accounts) == 0): ?>
                        <div role="alert" class="alert alert-info">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-current shrink-0 w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span>No accounts found! Create one by clicking here :
                                <button onclick="createAccount.showModal()" class="btn btn-info btn-sm">Create Account</button>
                            </span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="card w-2/5 ml-3 bg-base-700 shadow-xl">
            <div class="card-body">
                <h2 class="card-title text-lg font-semibold mb-4">Recent Transactions</h2>
                <div class="divide-y divide-gray-600">
                    <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="py-4 flex items-center justify-between transition duration-300 ease-in-out hover:bg-gray-800 pl-4 pr-4">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-gray-800 rounded-full flex items-center justify-center mr-4">
                                    <?php if($transaction->type === 'incoming'): ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <circle cx="12" cy="12" r="10" stroke="currentColor" fill="none" />
                                            <path d="M12 17V7M12 7L16 11M12 7L8 11" />
                                        </svg>
                                    <?php else: ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <polyline points="8 12 12 16 16 12"></polyline>
                                            <line x1="12" y1="8" x2="12" y2="16"></line>
                                        </svg>
                                    <?php endif; ?>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-gray-300"><?php echo e($transaction->type === 'incoming' ? 'Payment Received' : 'Payment Sent'); ?></p>
                                    <div class="flex flex-col text-xs text-gray-400">
                                        <span>From: <?php echo e($transaction->sender_account_number); ?></span>
                                        <span>To: <?php echo e($transaction->recipient_account_number); ?></span>
                                        <span><?php echo e($transaction->created_at->format('M d, Y')); ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="ml-auto flex items-center">
                                <p class="text-sm font-semibold <?php echo e($transaction->type === 'incoming' ? 'text-green-400' : 'text-red-400'); ?> pr-2">
                                    <?php echo e($transaction->type === 'incoming' ? '+$' : '-$'); ?><?php echo e(number_format($transaction->amount, 2)); ?></p>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH G:\Projects\InternetBank\resources\views/dashboard.blade.php ENDPATH**/ ?>