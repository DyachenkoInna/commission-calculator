<?php

declare(strict_types=1);

namespace Tests\Unit\Service;

use App\Service\Bin\BinlistApiInfoProvider;
use PHPUnit\Framework\TestCase;
use ReflectionProperty;
use Tests\Traits\MockBinlistAPI;

final class BinlistApiInfoProviderTest extends TestCase
{
    use MockBinlistAPI;

    public function testIsEuReturnTrueForEuCards(): void
    {
        $binlistApi = $this->mockBinlistAPI(true);

        $binInfoProvider = new BinlistApiInfoProvider();

        $apiReflection = new ReflectionProperty($binInfoProvider, 'binlistAPI');
        $apiReflection->setValue($binInfoProvider, $binlistApi);

        $this->assertTrue($binInfoProvider->isEu('euBin'));
    }

    public function testIsEuReturnFalseForNotEuCards(): void
    {
        $binlistApi = $this->mockBinlistAPI(false);

        $binInfoProvider = new BinlistApiInfoProvider();

        $apiReflection = new ReflectionProperty($binInfoProvider, 'binlistAPI');
        $apiReflection->setValue($binInfoProvider, $binlistApi);

        $this->assertFalse($binInfoProvider->isEu('nonEuBin'));
    }
}
