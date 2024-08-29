<?php

declare(strict_types=1);

namespace App\API\Binlist\DTO;

use App\DTO\BaseDTO;

class Bank extends BaseDTO
{
    private string $name;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }
}
