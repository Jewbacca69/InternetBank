<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Currency;
use App\Models\Transaction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'account_name' => 'required|string|min:4|max:12',
            'account_type' => 'required|in:Debit,Investment',
            'account_currency' => 'required',
        ]);

        $account = new Account();

        $account->owner_id = Auth::id();
        $account->name = $validatedData['account_name'];
        $account->type = $validatedData['account_type'];
        $account->currency = $validatedData['account_currency'];
        $account->account_number = "LV10AAA" . rand(1000000000, 9999999999);

        $account->save();

        return redirect()->route('dashboard')->with('success', 'Account created successfully!');
    }

    public function transferFunds(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'from_account' => 'required|exists:accounts,account_number',
            'to_account' => 'required|exists:accounts,account_number|different:from_account',
            'amount' => 'required|numeric|min:0.01',
        ]);

        $fromAccount = Account::where('account_number', $validatedData['from_account'])->first();
        $toAccount = Account::where('account_number', $validatedData['to_account'])->first();

        if ($fromAccount->balance < $validatedData['amount']) {
            return redirect()->route('dashboard')->with('error', 'Not enough money in the bank account!');
        }

        $conversionRate = $this->getConversionRate($fromAccount->currency, $toAccount->currency);

        if ($fromAccount->currency != $toAccount->currency && $conversionRate === null) {
            return redirect()->back()->with('error', 'Failed to fetch conversion rate.');
        }

        $convertedAmount = ($fromAccount->currency != $toAccount->currency) ? $validatedData['amount'] * $conversionRate : $validatedData['amount'];

        $fromAccount->decrement('balance', $validatedData['amount']);
        $toAccount->increment('balance', $convertedAmount);

        Transaction::create([
            'sender_id' => $fromAccount->owner_id,
            'recipient_id' => $toAccount->owner_id,
            'recipient_account_number' => $validatedData['to_account'],
            'sender_account_number' => $validatedData['from_account'],
            'amount' => $validatedData['amount'],
            'type' => 'outgoing',
        ]);

        Transaction::create([
            'sender_id' => $fromAccount->owner_id,
            'recipient_id' => $toAccount->owner_id,
            'recipient_account_number' => $validatedData['to_account'],
            'sender_account_number' => $validatedData['from_account'],
            'amount' => $convertedAmount,
            'type' => 'incoming',
        ]);

        return redirect()->route('dashboard')->with('success', 'Funds transferred successfully!');
    }

    public function getConversionRate($fromCurrency, $toCurrency): float|int|null
    {
        $fromRate = Currency::where('symbol', $fromCurrency)->value('price');
        $toRate = Currency::where('symbol', $toCurrency)->value('price');

        if ($fromRate && $toRate) {
            return $toRate / $fromRate;
        }

        return null;
    }
}
