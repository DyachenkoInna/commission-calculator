<?php

namespace App\Exception;

use Exception;
use Throwable;

class ValidationException extends Exception
{
    public function __construct(string $message = '', int $code = 422, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}