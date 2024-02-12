<dialog id="buyCrypto" class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg">Buy Crypto</h3>
        <form action="{{ route("crypto.buy") }}" method="post" class="p-4">
            @csrf
            <label>
                <select name="account_number" class="select select-bordered w-full mt-5 input-md">
                    <option disabled selected>Select the account which you'll use to purchase crypto</option>
                    @foreach($accounts as $account)
                        <option value="{{ $account->account_number }}">{{ $account->name }} ({{ $account->account_number }}) - {{ $account->balance  }} {{ $account->currency  }}</option>
                    @endforeach
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
