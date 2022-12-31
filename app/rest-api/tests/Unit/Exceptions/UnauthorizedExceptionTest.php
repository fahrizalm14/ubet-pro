<?php

namespace Tests\Unit;

use App\Exceptions\ClientException;
use App\Exceptions\UnauthorizedException;
use Exception;
use PHPUnit\Framework\TestCase;

class UnauthorizedExceptionTest extends TestCase
{
    public function test_should_called_correctly()
    {
        $isError = false;
        try {
            throw new UnauthorizedException();
        } catch (Exception $e) {
            $this->assertSame("UnauthorizedException", $e->name);
            $this->assertSame("Unauthorized", $e->getMessage());
            $this->assertSame(403, $e->getCode());
            $this->assertTrue($e instanceof ClientException);
            $isError = true;
        }

        $this->assertTrue($isError);
    }
}
