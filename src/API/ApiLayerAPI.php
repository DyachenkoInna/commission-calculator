<?php

declare(strict_types=1);

namespace App\API;

use App\Exception\ApiException;
use Exception;

/**
 * Class ExchangeRatesAPI
 *
 * This class is responsible for fetching exchange rates from ExchangeRatesAPI
 */
class ApiLayerAPI
{
    private string $baseUrl;

    private string $apiKey;

    public function __construct()
    {
        // ToDo: take from configs
        $this->baseUrl = 'https://api.apilayer.com';
        $this->apiKey = '51fN4Z62Bxdn41gzmmGqOBJoXehqD63A';
    }

    /**
     * Fetch latest exchange rates for a given currency
     *
     * @param string $baseCurrency
     * @return array
     * @throws Exception
     */
    public function latestRates(string $baseCurrency): array
    {
        $options = [
            'http' => [
                'header' => 'apikey:' . $this->apiKey,
            ],
        ];

        $context = stream_context_create($options);
        $url = $this->baseUrl . '/exchangerates_data/latest?base=' . $baseCurrency;
        $result = file_get_contents($url, context: $context);
        if ($result === false || !json_validate($result)) {
            throw new ApiException('Failed to fetch exchange rates from apilayer API.');
        }

        return json_decode($result, true)['rates'];
    }
}
