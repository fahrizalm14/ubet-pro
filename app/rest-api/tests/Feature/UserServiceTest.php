<?php

namespace Tests\Feature;

use App\Models\User;
use App\Services\Interfaces\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    use RefreshDatabase;
    protected $seed = true;

    public function test_success_provider()
    {
        $userService1 =
            $this->app->make(UserService::class);
        $userService2 =
            $this->app->make(UserService::class);

        $this->assertSame(
            $userService1
                ->getSchedules("f301ab93-1622-4702-853f-278493361600"),
            $userService2
                ->getSchedules("f301ab93-1622-4702-853f-278493361600")
        );
    }

    public function test_success_get_projects()
    {
        $id = User::inRandomOrder()->first()->id;
        $userService = $this->app->make(UserService::class);
        $project = $userService->getProjects($id);

        $this->assertIsArray($project);
        $this->assertSame($id, $project["id"]);
    }

    public function test_fail_get_projects()
    {
        $userService = $this->app->make(UserService::class);
        $project = $userService
            ->getProjects("f301ab93-1622-4702-853f-278493361600");

        $this->assertIsArray($project);
        // is empty array
        $this->assertSame([], $project);
    }

    public function test_success_get_schedules()
    {
        $id = User::inRandomOrder()->first()->id;
        $userService = $this->app->make(UserService::class);
        $project = $userService->getSchedules($id);

        $this->assertIsArray($project);
    }

    public function test_fail_get_schedules()
    {
        $userService = $this->app->make(UserService::class);
        $project = $userService
            ->getSchedules("f301ab93-1622-4702-853f-278493361600");

        $this->assertIsArray($project);
        // is empty array
        $this->assertSame([], $project);
    }
}
