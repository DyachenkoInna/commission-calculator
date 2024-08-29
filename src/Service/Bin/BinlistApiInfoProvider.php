<?php

declare(strict_types=1);

namespace App\Service\Bin;

use App\API\Binlist\BinlistAPI;

class BinlistApiInfoProvider implements BinInfoProviderInterface
{
    private BinlistAPI $binlistAPI;

    public function __construct()
    {
        $this->binlistAPI = new BinlistAPI();
    }

    public function isEu(string $bin): bool
    {
        $card = $this->binlistAPI->lookup($bin);

        return $card->isEu();
    }
}
