<?php

namespace App\Exception;

use Exception;
use Throwable;

class CurrencyNotFoundException extends Exception
{
    public function __construct(string $message = 'Currency not found.', int $code = 404, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
