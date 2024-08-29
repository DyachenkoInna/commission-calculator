<?php

namespace App\Service\ExchangeRate;

interface ExchangeRateProviderInterface
{
    public function getExchangeRate(string $fromCurrency, string $toCurrency): float;
}
