<?php

namespace Tests\Unit;

use App\Exceptions\ClientException;
use App\Exceptions\UnauthenticatedException;
use Exception;
use PHPUnit\Framework\TestCase;

class UnauthenticatedExceptionTest extends TestCase
{
    public function test_should_called_correctly()
    {
        $isError = false;
        try {
            throw new UnauthenticatedException();
        } catch (Exception $e) {
            $this->assertSame("UnauthenticatedException", $e->name);
            $this->assertSame("Unauthenticated", $e->getMessage());
            $this->assertSame(401, $e->getCode());
            $this->assertTrue($e instanceof ClientException);
            $isError = true;
        }

        $this->assertTrue($isError);
    }
}
