<?php

declare(strict_types=1);

namespace App\DTO;

class BaseDTO
{
    public function __construct(array $data = [])
    {
        foreach ($data as $key => $value) {
            if (method_exists($this, 'set' . ucfirst($key))) {
                $this->{'set' . ucfirst($key)}($value);
            } elseif (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }
}
