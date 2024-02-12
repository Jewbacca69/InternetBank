<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Crypto;
use App\Models\CryptoPortfolio;
use App\Models\Currency;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CryptoController extends Controller
{
    public function index(): View
    {
        $cryptos = Crypto::paginate(10);
        $accounts = Account::where('owner_id', auth()->user()->id)->get();
        $portfolio = CryptoPortfolio::with('crypto')->where('owner_id', auth()->user()->id)->get();

        $ownedCryptos = $portfolio->pluck('crypto_id')->toArray();
        $latestPriceChanges = Crypto::whereIn('id', $ownedCryptos)->pluck('price_change', 'symbol');


        return view('crypto.index', [
            'cryptos' => $cryptos,
            'portfolio' => $portfolio,
            'accounts' => $accounts,
            'latestPriceChanges' => $latestPriceChanges,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'crypto_id' => 'required|integer',
            'account_number' => 'required|string',
            'amount' => 'required|numeric',
        ]);

        $crypto = Crypto::find($request->crypto_id);
        $account = Account::where('account_number', $request->account_number)->first();

        $convertToUsd = $this->getConversionRate($account->currency, 'USD');

        if ($convertToUsd === null) {
            return redirect()->back()->with('error', 'Failed to fetch conversion rate.');
        }

        $cryptoPriceUsd = $crypto->price;
        $totalPriceUsd = $cryptoPriceUsd * $request->amount;
        $totalPriceAccountCurrency = $totalPriceUsd / $convertToUsd;

        if ($account->balance < $totalPriceAccountCurrency) {
            return redirect()->back()->with('error', 'Not enough money in the bank account!');
        }

        $account->decrement('balance', $totalPriceAccountCurrency);

        $cryptoPortfolio = CryptoPortfolio::where('owner_id', auth()->user()->id)
            ->where('crypto_id', $request->crypto_id)
            ->first();

        $symbol = Crypto::where('id', $request->crypto_id)->first()->symbol;

        if ($cryptoPortfolio) {
            $cryptoPortfolio->update([
                'balance' => $cryptoPortfolio->balance + $request->amount,
            ]);
        } else {
            CryptoPortfolio::create([
                'owner_id' => auth()->user()->id,
                'crypto_id' => $request->crypto_id,
                'crypto_address' => $symbol . '_' . bin2hex(random_bytes(8)),
                'balance' => $request->amount,
            ]);
        }

        return redirect()->back()->with(
            'success', 'You have successfully purchased '
            . $request->amount . ' ' . $crypto->name .
            ' coins. for ' .
            $account->currency . ' ' . $totalPriceAccountCurrency);
    }

    public function sellCrypto(Request $request): RedirectResponse
    {
        $request->validate([
            'crypto_account' => 'required|int',
            'account_number' => 'required|string',
            'amount' => 'required|numeric',
        ]);
        $crypto = Crypto::where('id', $request->crypto_account)->first();
        $account = Account::where('account_number', $request->account_number)->first();

        if (!$crypto || !$account) {
            return redirect()->back()->with('error', 'Invalid crypto or account details.');
        }

        $cryptoPortfolio = CryptoPortfolio::where('owner_id', auth()->user()->id)
            ->where('crypto_id', $crypto->id)
            ->first();

        if (!$cryptoPortfolio || $cryptoPortfolio->balance < $request->amount) {
            return redirect()->back()->with('error', 'Insufficient cryptocurrency balance.');
        }

        $convertToAccountCurrency = $this->getConversionRate('USD', $account->currency);

        if ($convertToAccountCurrency === null) {
            return redirect()->back()->with('error', 'Failed to fetch conversion rate.');
        }

        $saleAmount = $request->amount * $crypto->price * $convertToAccountCurrency;

        $account->increment('balance', $saleAmount);
        $cryptoPortfolio->decrement('balance', $request->amount);

        return redirect()->back()->with('success', 'You have successfully sold ' . $request->amount . ' ' . $crypto->name . ' coins for ' . $account->currency . ' ' . $saleAmount);
    }

    public function getConversionRate($from, $to): ?float
    {
        $fromCurrency = Currency::where('symbol', $from)->first();
        $toCurrency = Currency::where('symbol', $to)->first();

        if ($fromCurrency && $toCurrency) {
            return $toCurrency->price / $fromCurrency->price;
        }

        return null;
    }
}
