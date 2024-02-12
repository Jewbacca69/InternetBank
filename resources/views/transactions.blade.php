<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            👋 Welcome, {{ Auth::user()->name }}!
        </h2>
    </x-slot>

    <div class="container mx-auto py-8 flex">
        <div class="card w-full ml-3 bg-base-700 shadow-xl">
            <div class="card-body">
                <h2 class="card-title text-lg font-semibold mb-4">Your Transactions</h2>
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
