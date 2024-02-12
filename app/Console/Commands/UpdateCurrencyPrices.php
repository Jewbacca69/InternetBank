<?php

namespace App\Console\Commands;

use App\Models\Currency;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class UpdateCurrencyPrices extends Command
{
    protected $signature = 'app:update-currency-prices';

    protected $description = 'Command description';

    private const BASE_CURRENCY = 'USD';

    private const API_URL = 'https://api.coinbase.com/v2/';

    public function handle(): void
    {
        $response = Http::get(self::API_URL . 'currencies');
        $currencies = json_decode($response->body());

        $response = Http::get(self::API_URL . "exchange-rates?currency=" . self::BASE_CURRENCY);
        $rates = json_decode($response->body());

        foreach ($currencies->data as $currency) {
            $this->info("Updating $currency->name...");

            Currency::updateOrCreate(
                ['symbol' => $currency->id],
                [
                    'name' => $currency->name,
                    'symbol' => $currency->id,
                    'price' => $rates->data->rates->{$currency->id},
                ]
            );
        }
    }
}
