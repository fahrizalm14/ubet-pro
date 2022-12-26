<?php

namespace App\Exceptions;

use Exception;

abstract class ClientException extends Exception
{
    public $name = "ClientException";
    public function __construct(string $message = "Client error", int $code = 400)
    {
        parent::__construct($message, $code);
    }
}
