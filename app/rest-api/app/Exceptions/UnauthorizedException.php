<?php

namespace App\Exceptions;

class UnauthorizedException extends ClientException
{
    public function __construct(string $message = "Unauthorized")
    {
        parent::__construct($message, 403);
        $this->name = "UnauthorizedException";
    }
}
