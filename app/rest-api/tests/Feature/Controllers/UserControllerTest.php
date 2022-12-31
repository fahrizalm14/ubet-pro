<?php

namespace Tests\Feature\Controllers;

use App\Models\User;

class UserControllerTest extends ControllerTest
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_projects()
    {
        $response = $this->withCookie(
            "user_id",
            User::inRandomOrder()->first()->id
        )->get('/api/users/projects');

        $this->_response_withData($response);
        $response->assertStatus(200);
    }

    public function test_get_schedules()
    {
        $response = $this->withCookie(
            "user_id",
            User::inRandomOrder()->first()->id
        )->get('/api/users/schedules');
        $this->_response_withData($response);

        $response->assertStatus(200);
    }
}
