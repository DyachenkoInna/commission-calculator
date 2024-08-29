<?php

declare(strict_types=1);

namespace Tests\Traits;

use App\API\ApiLayerAPI;
use Mockery;

trait MockApiLayerAPI
{
    private function mockApiLayerAPI(string $currency, float $rate): ApiLayerAPI
    {
        return Mockery::mock(ApiLayerAPI::class, function ($mock) use ($currency, $rate) {
            $mock->shouldReceive('latestRates')
                ->andReturn([$currency => $rate]);
        });
    }
}
