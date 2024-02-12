<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            👋 Welcome, {{ Auth::user()->name }}!
        </h2>
    </x-slot>
    @include('components.swal')
    @include('modals.create-account')
    @include('modals.transfer-money')
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
                        @foreach($accounts as $account)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($account->type == 'Investment')
                                        <div class="badge badge-accent badge-outline">Investment</div>
                                    @elseif($account->type == 'Debit')
                                        <div class="badge badge-primary badge-outline">Debit</div>
                                    @else
                                        <div class="badge badge-primary badge-outline">Unknown</div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $account->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $account->account_number }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $account->currency }} {{ $account->balance }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $account->currency }}</td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @if(count($accounts) == 0)
                        <div role="alert" class="alert alert-info">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-current shrink-0 w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span>No accounts found! Create one by clicking here :
                                <button onclick="createAccount.showModal()" class="btn btn-info btn-sm">Create Account</button>
                            </span>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="card w-2/5 ml-3 bg-base-700 shadow-xl">
            <div class="card-body">
                <h2 class="card-title text-lg font-semibold mb-4">Recent Transactions</h2>
                <div class="divide-y divide-gray-600">
                    @foreach($transactions as $transaction)
                        <div class="py-4 flex items-center justify-between transition duration-300 ease-in-out hover:bg-gray-800 pl-4 pr-4">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-gray-800 rounded-full flex items-center justify-center mr-4">
                                    @if($transaction->type === 'incoming')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <circle cx="12" cy="12" r="10" stroke="currentColor" fill="none" />
                                            <path d="M12 17V7M12 7L16 11M12 7L8 11" />
                                        </svg>
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <polyline points="8 12 12 16 16 12"></polyline>
                                            <line x1="12" y1="8" x2="12" y2="16"></line>
                                        </svg>
                                    @endif
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-gray-300">{{ $transaction->type === 'incoming' ? 'Payment Received' : 'Payment Sent' }}</p>
                                    <div class="flex flex-col text-xs text-gray-400">
                                        <span>From: {{ $transaction->sender_account_number }}</span>
                                        <span>To: {{ $transaction->recipient_account_number }}</span>
                                        <span>{{ $transaction->created_at->format('M d, Y') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="ml-auto flex items-center">
                                <p class="text-sm font-semibold {{ $transaction->type === 'incoming' ? 'text-green-400' : 'text-red-400' }} pr-2">
                                    {{ $transaction->type === 'incoming' ? '+$' : '-$' }}{{ number_format($transaction->amount, 2) }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
