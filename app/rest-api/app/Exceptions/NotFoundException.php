<?php

namespace App\Exceptions;

class NotFoundException extends ClientException
{
    public function __construct(string $message = "Not found")
    {
        parent::__construct($message, 404);
        $this->name = "NotFoundException";
    }
}
