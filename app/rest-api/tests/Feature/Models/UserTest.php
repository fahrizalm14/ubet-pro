<?php

namespace Tests\Feature\Models;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    protected $seed = true;

    public function test_factory_model_exist()
    {
        $user = User::factory()->create();
        $this->assertModelExists($user);
    }

    public function test_user_can_be_created()
    {
        $this->assertDatabaseCount('users', 5);
    }
}
