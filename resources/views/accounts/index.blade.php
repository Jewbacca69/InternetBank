<!-- resources/views/accounts/index.blade.php -->

@extends('layouts.app') <!-- Assuming you have a layout file -->

@section('content')
    <h1>Your Bank Accounts</h1>

    @if ($accounts && $accounts->count() > 0)
        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>Currency</th>
                <th>Balance</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($accounts as $account)
                <tr>
                    <td>{{ $account->id }}</td>
                    <td>{{ $account->currency }}</td>
                    <td>{{ $account->balance }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <p>No accounts found.</p>
    @endif
@endsection
