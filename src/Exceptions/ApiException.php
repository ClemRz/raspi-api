<?php

namespace Exceptions;

use Exception;

class ApiException extends Exception
{
    public function __construct($message, $code, Exception $previous = null)
    {
        parent::__construct("API exception, {$message}", $code, $previous);
    }
}