<?php

declare(strict_types=1);

namespace App\Service;

use App\Service\ExchangeRate\ExchangeRateProviderInterface;

class CommissionCalculator
{
    public const string EUR = 'EUR';

    private ExchangeRateProviderInterface $exchangeRatesProvider;

    public function __construct(ExchangeRateProviderInterface $exchangeRatesProvider)
    {
        $this->exchangeRatesProvider = $exchangeRatesProvider;
    }

    /**
     * Calculate commission for given currency and amount
     *
     * @param string $currency
     * @param float $amount
     * @param bool $isEu
     * @return float
     */
    public function calculate(string $currency, float $amount, bool $isEu): float
    {
        $amount = $this->getAmountInEur($amount, $currency);
        $commission = $this->getCommission($isEu);

        return $this->ceilToTwoDecimals($amount *  $commission);
    }

    /**
     * Ceil given value to two decimals
     *
     * @param float $value
     * @return float
     */
    private function ceilToTwoDecimals(float $value): float
    {
        return ceil($value * 100) / 100;
    }

    /**
     * Convert amount to EUR
     *
     * @param float $amount
     * @param string $currency
     * @return float
     */
    private function getAmountInEur(float $amount, string $currency): float
    {
        $rate = $this->exchangeRatesProvider->getExchangeRate($currency, self::EUR);

        if ($currency !== self::EUR || $rate > 0) {
            $amount /= $rate;
        }

        return $amount;
    }

    /**
     * We apply different commission rates for EU-issued and non-EU-issued cards
     *
     * @param bool $isEu
     * @return float
     */
    private function getCommission(bool $isEu): float
    {
        // ToDo: take from configs
        $commissionForEUIssuedCard = 0.01;
        $commissionForNonEUIssuedCard = 0.02;

        return $isEu ? $commissionForEUIssuedCard : $commissionForNonEUIssuedCard;
    }
}
