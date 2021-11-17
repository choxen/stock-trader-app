<?php

namespace App\Repositories;

use App\Models\CompanyProfile;
use App\Models\StockData;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;

class StocksRepository implements StocksRepositoryInterface
{
    private Client $client;
    private string $apiKey;

    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->apiKey = env('FINHUB_API_KEY');
    }

    public function stockData(string $q): array
    {
        $q = strtoupper($q);

        $url = 'https://finnhub.io/api/v1/search?q=' . $q . '&token=' . $this->apiKey;
        $res = $this->client->request('GET', $url);

        if (Cache::has('company.symbol.' . $q)) {
            return Cache::get('company.symbol.' . $q);
        }

        $data = json_decode($res->getBody(), true);

        Cache::put('company.symbol.' . $q, $data['result'][0], now()->addMinutes(10));

        return $data['result'][0];
    }

    public function companyProfile(string $symbol): CompanyProfile
    {
        $symbol = strtoupper($symbol);
        $url = 'https://finnhub.io/api/v1/stock/profile2?symbol=' . $symbol . '&token=' . $this->apiKey;
        $res = $this->client->request('GET', $url);

        if (Cache::has('company.profile.' . $symbol)) {
            return new CompanyProfile(Cache::get('company.profile.' . $symbol));
        }

        $companyProfileData = json_decode($res->getBody(), true);

        Cache::put('company.profile.' . $symbol, $companyProfileData, now()->addMinutes(10));

        return new CompanyProfile($companyProfileData);
    }

    public function companyQuoteData(string $symbol): StockData
    {
        $url = 'https://finnhub.io/api/v1/quote?symbol=' . $symbol . '&token=' . $this->apiKey;
        $res = $this->client->request('GET', $url);

        $companyQuoteData = json_decode($res->getBody(), true);

        return new StockData($companyQuoteData);
    }
}
