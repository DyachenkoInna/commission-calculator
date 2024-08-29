<?php

declare(strict_types=1);

namespace App\DTO;

class Transaction extends BaseDTO
{
    private string $bin;
    private float $amount;
    private string $currency;

    public function getBin(): string
    {
        return $this->bin;
    }

    public function setBin(string $bin): void
    {
        $this->bin = $bin;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function setAmount($amount): void
    {
        $this->amount = (float)$amount;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function setCurrency(string $currency): void
    {
        $this->currency = $currency;
    }

    public function isValid(): bool
    {
        return isset($this->bin)
            && isset($this->amount)
            && isset($this->currency);
    }
}
