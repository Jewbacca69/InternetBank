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
    <script>
        function displayModal(cryptoId) {
            var modal = document.getElementById("buyCrypto");

            var inputField = modal.querySelector('input[name="crypto_id"]');
            inputField.value = cryptoId;

            modal.showModal();
        }
    </script>
    <?php echo $__env->make('components.swal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('modals.buy-crypto', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('modals.sell-crypto', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="container mx-auto py-8 flex">
        <div class="card w-3/5 bg-base-700 shadow-lg">
            <div class="card-body">
                <h2 class="card-title text-lg font-semibold mb-4">Your Crypto Accounts
                    <span class="float-right">
                        <button onclick="sellCrypto.showModal()" class="btn btn-outline btn-sm btn-accent">Sell Crypto</button>
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
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Price Change</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-600">

                        <?php $__currentLoopData = $portfolio; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cryptoAccount): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="badge badge-accent badge-outline">Crypto</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap"><?php echo e($cryptoAccount->crypto->name); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap"><?php echo e($cryptoAccount->crypto_address); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap"><?php echo e($cryptoAccount->currency); ?> <?php echo e($cryptoAccount->balance); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap
                                    <?php if(isset($latestPriceChanges[$cryptoAccount->crypto->symbol])): ?>
                                        <?php echo e($latestPriceChanges[$cryptoAccount->crypto->symbol] >= 0 ? 'text-green-500' : 'text-red-500'); ?>

                                    <?php endif; ?>">
                                    <?php if(isset($latestPriceChanges[$cryptoAccount->crypto->symbol])): ?>
                                        <?php echo e($latestPriceChanges[$cryptoAccount->crypto->symbol]); ?>%
                                    <?php else: ?>
                                        N/A
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </tbody>
                    </table>
                    <?php if(count($portfolio) == 0): ?>
                        <div role="alert" class="alert alert-info">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-current shrink-0 w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span>You don't have any crypto accounts. Purchase a coin to create one.</span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="card w-2/5 ml-3 bg-base-700 shadow-xl">
            <div class="card-body">
                <h2 class="card-title text-lg font-semibold mb-4">Buy Crypto</h2>
                <div class="max-w-3xl w-full bg-gray-800 p-4  shadow-lg">
                    <table class="w-full bg-gray-900 divide-y divide-gray-900">
                        <thead class="bg-gray-800">
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-semibold">Icon</th>
                            <th class="px-4 py-2 text-left text-xs font-semibold">Name</th>
                            <th class="px-4 py-2 text-left text-xs font-semibold">Symbol</th>
                            <th class="px-4 py-2 text-left text-xs font-semibold">Price</th>
                            <th class="px-4 py-2 text-left text-xs font-semibold">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $cryptos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $crypto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="hover:bg-gray-700 transition-colors">
                                <td class="px-4 py-2 w-2"><img width="25px" src="https://coinicons-api.vercel.app/api/icon/<?php echo e(strtolower($crypto->symbol)); ?>"></td>
                                <td class="px-4 py-2"><?php echo e($crypto->name); ?></td>
                                <td class="px-4 py-2"><?php echo e($crypto->symbol); ?></td>
                                <td class="px-4 py-2">$ <?php echo e($crypto->price); ?></td>
                                <td class="px-4 py-2">
                                    <button onclick="displayModal('<?php echo e($crypto->id); ?>')" class="btn btn-outline btn-accent btn-sm">Buy</button>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>

                    <div class="w-full flex justify-center mt-4">
                        <div class="join flex">
                            <?php $__currentLoopData = $cryptos->getUrlRange(1, $cryptos->lastPage()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <button class="join-item btn btn-md<?php echo e(($cryptos->currentPage() == $page) ? ' btn-active' : ''); ?>">
                                    <a href="<?php echo e($url); ?>"><?php echo e($page); ?></a>
                                </button>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>

                </div>
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
<?php /**PATH G:\Projects\InternetBank\resources\views/crypto/index.blade.php ENDPATH**/ ?>