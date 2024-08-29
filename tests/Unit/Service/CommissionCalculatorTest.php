<?php

declare(strict_types=1);

namespace Tests\Unit\Service;

use App\Service\{
    CommissionCalculator,
    ExchangeRate\ExchangeRateApiLayerProvider,
};
use PHPUnit\Framework\TestCase;
use ReflectionProperty;
use Tests\Traits\MockApiLayerAPI;

final class CommissionCalculatorTest extends TestCase
{
    use MockApiLayerAPI;

    public function testCommissionCalculatesCorrect(): void
    {
        $currency = 'USD';
        $rate = 0.9;
        $amount = 100;

        $exchangeApi = $this->mockApiLayerAPI($currency, $rate);

        $provider = new ExchangeRateApiLayerProvider();
        $apiReflection = new ReflectionProperty($provider, 'apiLayerAPI');
        $apiReflection->setValue($provider, $exchangeApi);

        $commissionCalculator = new CommissionCalculator($provider);

        $commission = $commissionCalculator->calculate($currency, $amount, false);

        $this->assertSame(2.23, $commission);
    }
}
