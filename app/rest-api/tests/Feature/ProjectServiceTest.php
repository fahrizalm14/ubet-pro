<?php

namespace Tests\Feature;

use App\Services\Interfaces\ProjectService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectServiceTest extends TestCase
{
    use RefreshDatabase;
    protected $seed = true;

    public function test_provider()
    {
        $projectService1 = $this->app->make(ProjectService::class);
        $projectService2 = $this->app->make(ProjectService::class);

        $this->assertSame($projectService1->getAll(), $projectService2->project->getAll());
    }

    public function test_get_all()
    {
        $projectService = $this->app->make(ProjectService::class);

        dd(count($projectService->getAll()));
        $this->assertSame(20, count($projectService->getAll()));
    }
}
