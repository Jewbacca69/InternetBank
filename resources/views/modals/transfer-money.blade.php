<dialog id="transferMoney" class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg">Transfer Money</h3>
        <form action="{{ route("accounts.transfer") }}" method="post" class="p-4">
            @csrf
            <label>
                <select name="from_account" class="select select-bordered w-full mt-5 input-md">
                    <option disabled selected>Select account from which you'll transfer</option>
                    @foreach($accounts as $account)
                        <option value="{{ $account->account_number }}">{{ $account->name }} ({{ $account->account_number }}) - {{ $account->balance  }}</option>
                    @endforeach
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
