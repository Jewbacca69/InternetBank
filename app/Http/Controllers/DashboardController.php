<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(): View
    {
        $accounts = Account::where('owner_id', auth()->id())->get();

        $incomingTransactions = Transaction::where('recipient_id', Auth::id())
            ->where('type', 'incoming')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $outgoingTransactions = Transaction::where('sender_id', Auth::id())
            ->where('type', 'outgoing')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $allTransactions = $incomingTransactions->merge($outgoingTransactions)->sortByDesc('created_at');

        return view('dashboard', [
            'accounts' => $accounts,
            'transactions' => $allTransactions,
        ]);
    }
}
