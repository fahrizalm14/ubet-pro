<?php

namespace App\Exceptions;

use Exception;

class ClientException extends Exception
{
    public $name = "ClientException";
    public function __construct(string $message = "Bad request", int $code = 400)
    {
        parent::__construct($message, $code);
    }
}
