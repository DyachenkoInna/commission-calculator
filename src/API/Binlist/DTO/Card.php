<?php

declare(strict_types=1);

namespace App\API\Binlist\DTO;

use App\DTO\BaseDTO;

class Card extends BaseDTO
{
    private string $scheme;
    private string $type;
    private string $brand;
    private Country $country;
    private Bank $bank;

    public function getScheme(): string
    {
        return $this->scheme;
    }

    public function setScheme(string $scheme): void
    {
        $this->scheme = $scheme;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function getBrand(): string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): void
    {
        $this->brand = $brand;
    }

    public function getCountry(): Country
    {
        return $this->country;
    }

    public function setCountry(Country|array $country): void
    {
        $this->country = is_array($country) ? new Country($country) : $country;
    }

    public function getBank(): Bank
    {
        return $this->bank;
    }

    public function setBank(Bank|array $bank): void
    {
        $this->bank = is_array($bank) ? new Bank($bank) : $bank;
    }

    public function isEu(): bool
    {
        return $this->country->isEu();
    }
}
