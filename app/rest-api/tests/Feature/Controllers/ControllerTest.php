<?php

namespace Tests\Feature\Controllers;

use Illuminate\Testing\TestResponse;
use Tests\TestCase;

abstract class ControllerTest extends TestCase
{
    protected function _response(TestResponse $response)
    {

        $this->assertArrayHasKey("success", $response);
        $this->assertArrayHasKey("message", $response);
    }

    protected function _response_withData(TestResponse $response)
    {

        $this->_response($response);
        $this->assertArrayHasKey("data", $response);
    }
}
