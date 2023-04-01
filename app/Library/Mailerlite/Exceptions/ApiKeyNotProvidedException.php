<?php

namespace App\Library\Mailerlite\Exceptions;

use Exception;

class ApiKeyNotProvidedException extends Exception
{
    public function __construct()
    {
        parent::__construct('API key not found, please provide.');
    }
}
