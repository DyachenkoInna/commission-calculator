<?php

declare(strict_types=1);

namespace App\Service\ExchangeRate;

use App\API\ApiLayerAPI;
use App\Exception\CurrencyNotFoundException;

class ExchangeRateApiLayerProvider implements ExchangeRateProviderInterface
{
    private ApiLayerAPI $apiLayerAPI;
    private array $rates;

    public function __construct()
    {
        $this->apiLayerAPI = new ApiLayerAPI();
    }

    public function getExchangeRate(string $fromCurrency, string $toCurrency): float
    {
        $rates = $this->latestRates($toCurrency);

        if (!isset($rates[$fromCurrency])) {
            throw new CurrencyNotFoundException('Currency "' . $fromCurrency . '" not found in exchange rates.');
        }

        return $rates[$fromCurrency];
    }

    private function latestRates(string $baseCurrency): array
    {
        if (!isset($this->rates)) {
            $this->rates = $this->apiLayerAPI->latestRates($baseCurrency);
        }

        return $this->rates;
    }
}
