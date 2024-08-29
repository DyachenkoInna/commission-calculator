<?php

declare(strict_types=1);

namespace Tests\Unit\Service;

use App\Exception\CurrencyNotFoundException;
use App\Service\ExchangeRate\ExchangeRateApiLayerProvider;
use PHPUnit\Framework\TestCase;
use ReflectionProperty;
use Tests\Traits\MockApiLayerAPI;

final class ExchangeRateApiLayerProviderTest extends TestCase
{
    use MockApiLayerAPI;

    public function testGetExchangeRateReturnsGivenRate(): void
    {
        $currency = 'USD';
        $baseCurrency = 'EUR';
        $rate = 0.9;
        $exchangeApi = $this->mockApiLayerAPI($currency, $rate);

        $provider = new ExchangeRateApiLayerProvider();

        $apiReflection = new ReflectionProperty($provider, 'apiLayerAPI');
        $apiReflection->setValue($provider, $exchangeApi);

        $this->assertSame($provider->getExchangeRate($currency, $baseCurrency), $rate);
    }

    public function testGetExchangeRateForNotExistedCurrencyThrowsException(): void
    {
        $baseCurrency = 'EUR';
        $exchangeApi = $this->mockApiLayerAPI($baseCurrency, 1.0);

        $provider = new ExchangeRateApiLayerProvider();

        $apiReflection = new ReflectionProperty($provider, 'apiLayerAPI');
        $apiReflection->setValue($provider, $exchangeApi);

        $this->expectException(CurrencyNotFoundException::class);

        $provider->getExchangeRate('wrongCurrency', $baseCurrency);
    }
}
