<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class TransactionsController extends Controller
{
    public function index(): View
    {

        $incomingTransactions = Transaction::where('recipient_id', Auth::id())
            ->where('type', 'incoming')
            ->orderBy('created_at', 'desc')
            ->get();

        $outgoingTransactions = Transaction::where('sender_id', Auth::id())
            ->where('type', 'outgoing')
            ->orderBy('created_at', 'desc')
            ->get();

        $allTransactions = $incomingTransactions->merge($outgoingTransactions)->sortByDesc('created_at');

        return view('transactions', [
            'transactions' => $allTransactions,
        ]);
    }
}
