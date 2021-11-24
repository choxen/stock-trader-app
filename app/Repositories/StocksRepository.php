<?php

namespace App\Repositories;

use App\Models\CompanyProfile;
use App\Models\StockData;
use App\Models\StockQuoteData;
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

    public function stockData(string $q): StockData
    {
        $q = strtoupper($q);

        if (Cache::has('company.symbol.' . $q)) {
            return new StockData(Cache::get('company.symbol.' . $q));
        }

        $url = 'https://finnhub.io/api/v1/search?q=' . $q . '&token=' . $this->apiKey;
        $res = $this->client->request('GET', $url);

        $data = json_decode($res->getBody(), true);
        $firstRecord = $data['result'][0];
        $stockData = new StockData($firstRecord);

        Cache::put('company.symbol.' . $q, $firstRecord, now()->addMinutes(10));

        return $stockData;
    }

    public function companyProfile(string $symbol): CompanyProfile
    {
        $symbol = strtoupper($symbol);

        if (Cache::has('company.profile.' . $symbol)) {
            return new CompanyProfile(Cache::get('company.profile.' . $symbol));
        }

        $url = 'https://finnhub.io/api/v1/stock/profile2?symbol=' . $symbol . '&token=' . $this->apiKey;
        $res = $this->client->request('GET', $url);

        $companyProfileData = json_decode($res->getBody(), true);

        Cache::put('company.profile.' . $symbol, $companyProfileData, now()->addMinutes(10));

        return new CompanyProfile($companyProfileData);
    }

    public function companyQuoteData(string $symbol): StockQuoteData
    {
        if (Cache::has('company.quote.data.' . $symbol)) {
            return new StockQuoteData(Cache::get('company.quote.data.' . $symbol));
        }

        $url = 'https://finnhub.io/api/v1/quote?symbol=' . $symbol . '&token=' . $this->apiKey;
        $res = $this->client->request('GET', $url);

        $companyQuoteData = json_decode($res->getBody(), true);

        Cache::put('company.quote.data.' . $symbol, $companyQuoteData, now()->addMinutes(10));

        return new StockQuoteData($companyQuoteData);
    }
}
