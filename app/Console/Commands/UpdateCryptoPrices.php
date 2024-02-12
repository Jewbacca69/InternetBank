<?php

namespace App\Console\Commands;

use App\Models\Crypto;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class UpdateCryptoPrices extends Command
{
    protected $signature = 'app:update-crypto-prices';

    protected $description = 'Command description';

    public function handle(): void
    {
        $this->info("Updating crypto prices...");

        $request = Http::withOptions(['verify' => false])
            ->get("https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest", [
                'CMC_PRO_API_KEY' => env('COINMARKETCAP_API_KEY'),
                'convert' => 'USD',
            ]);

        $crypto = json_decode($request->body());

        foreach ($crypto->data as $coin) {
            $this->info("Updating $coin->name...");
            Crypto::updateOrCreate(
                ['symbol' => $coin->symbol],
                [
                    'name' => $coin->name,
                    'symbol' => $coin->symbol,
                    'price' => $coin->quote->USD->price,
                    'price_change' => $coin->quote->USD->percent_change_24h,
                ]
            );
        }

        $this->info("All done!");
    }
}
