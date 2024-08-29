<?php

namespace App\Service\Bin;

interface BinInfoProviderInterface
{
    public function isEu(string $bin): bool;
}
