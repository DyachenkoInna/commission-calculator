<?php

declare(strict_types=1);

namespace App\API\Binlist\DTO;

use App\DTO\BaseDTO;

class Country extends BaseDTO
{
    public const array EU_ALPHA2_CODES = [
        'AT', 'BE', 'BG', 'CY', 'CZ', 'DE', 'DK', 'EE', 'ES', 'FI', 'FR', 'GR', 'HR', 'HU',
        'IE', 'IT', 'LT', 'LU', 'LV', 'MT', 'NL', 'PO', 'PT', 'RO', 'SE', 'SI', 'SK',
    ];

    private string $numeric;
    private string $alpha2;
    private string $name;
    private string $emoji;
    private string $currency;
    private int $latitude;
    private int $longitude;

    public function getNumeric(): string
    {
        return $this->numeric;
    }

    public function setNumeric(string $numeric): void
    {
        $this->numeric = $numeric;
    }

    public function getAlpha2(): string
    {
        return $this->alpha2;
    }

    public function setAlpha2(string $alpha2): void
    {
        $this->alpha2 = $alpha2;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getEmoji(): string
    {
        return $this->emoji;
    }

    public function setEmoji(string $emoji): void
    {
        $this->emoji = $emoji;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function setCurrency(string $currency): void
    {
        $this->currency = $currency;
    }

    public function getLatitude(): int
    {
        return $this->latitude;
    }

    public function setLatitude(int $latitude): void
    {
        $this->latitude = $latitude;
    }

    public function getLongitude(): int
    {
        return $this->longitude;
    }

    public function setLongitude(int $longitude): void
    {
        $this->longitude = $longitude;
    }

    public function isEu(): bool
    {
        return in_array($this->alpha2, self::EU_ALPHA2_CODES, true);
    }
}
