<?php

namespace Exceptions;

use Exception;

class ValidationException extends Exception
{
    public function __construct($message, $code, Exception $previous = null)
    {
        parent::__construct("Validation exception, {$message}", $code, $previous);
    }
}