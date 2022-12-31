<?php

namespace Tests\Unit;

use App\Exceptions\ClientException;
use App\Exceptions\NotFoundException;
use Exception;
use PHPUnit\Framework\TestCase;

class NotFoundExceptionTest extends TestCase
{
    public function test_should_called_correctly()
    {
        $isError = false;
        $msg = "Testing Not Found";
        try {
            throw new NotFoundException($msg);
        } catch (Exception $e) {
            $this->assertSame("NotFoundException", $e->name);
            $this->assertSame($msg, $e->getMessage());
            $this->assertSame(404, $e->getCode());
            $this->assertTrue($e instanceof ClientException);
            $isError = true;
        }

        $this->assertTrue($isError);
    }
}
