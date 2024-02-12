<dialog id="sellCrypto" class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg">Sell Crypto</h3>
        <form action="{{ route('crypto.sell') }}" method="post" class="p-4">
            @csrf
            <label>
                <select name="crypto_account" class="select select-bordered w-full mt-5 input-md">
                    <option disabled selected>Select the account from which you'll sell crypto</option>
                    @foreach($portfolio as $cryptoAccount)
                        <option value="{{ $cryptoAccount->crypto_id }}">{{ $cryptoAccount->crypto_address }}) - {{ $cryptoAccount->balance  }}</option>
                    @endforeach
                </select>
            </label>
            <label>
                <select name="account_number" class="select select-bordered w-full mt-5 input-md">
                    <option disabled selected>Select the account to which the funds will go</option>
                    @foreach($accounts as $account)
                        <option value="{{ $account->account_number }}">{{ $account->name }} ({{ $account->account_number }}) - {{ $account->balance  }} {{ $account->currency  }}</option>
                    @endforeach
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
