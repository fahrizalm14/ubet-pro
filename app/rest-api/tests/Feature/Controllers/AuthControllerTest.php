<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;
    protected $seed = true;
    public function test_login()
    {
        // dump(strlen(User::inRandomOrder()->first()->id));
        $user = User::inRandomOrder()->first();
        $data = [
            "username" => $user["username"],
            "password" => "password"
        ];
        $response = $this->postJson('api/login', $data);

        $response->assertStatus(200);
        $response->assertCookie("user_id", $user["id"], false);
    }

    public function test_register()
    {
        $data = [
            'fullName' => "Muhammad Andri Fahrizal",
            'username' => "fahrizal14",
            'password' => "password",
        ];
        $response = $this->postJson('api/register', $data);
        $response->assertStatus(201);
        $response->assertCookie("user_id");
    }

    public function test_logout()
    {
        $userId = User::inRandomOrder()->first()->id;
        $response = $this->withCookie(
            "user_id",
            $userId
        )->delete('api/logout');

        $response->assertStatus(200);
        $response->assertCookieMissing("user_id");
    }
}
