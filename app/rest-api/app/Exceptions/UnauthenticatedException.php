<?php

namespace App\Exceptions;

class UnauthenticatedException extends ClientException
{
    public function __construct(string $message = "Unauthenticated")
    {
        parent::__construct($message, 401);
        $this->name = "UnauthenticatedException";
    }
}
