<dialog id="createAccount" class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg">Create Account</h3>
        <form action="{{ route("accounts.store") }}" method="post" class="p-4">
            @csrf

            <label>
                <input type="text" name="account_name" placeholder="Name" class="input input-md input-bordered w-full"/>
            </label>

            <label>
                <select name="account_type" class="select select-bordered w-full mt-5 input-md">
                    <option disabled selected>Select account type</option>
                    <option>Debit</option>
                    <option>Investment</option>
                </select>
            </label>

            <label>
                <select name="account_currency" class="select select-bordered w-full mt-5 input-md">
                    <option disabled selected>Select accounts currency</option>
                    <option>USD</option>
                    <option>EUR</option>
                    <option>GBP</option>
                    <option>PLN</option>
                </select>
            </label>

            <button type="submit" class="btn btn-outline btn-accent w-full mt-5">Create Account</button>
        </form>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>
