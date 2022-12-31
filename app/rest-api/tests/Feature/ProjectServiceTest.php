<?php

namespace Tests\Feature;

use App\Exceptions\ClientException;
use App\Models\Project;
use App\Models\User;
use App\Services\Interfaces\ProjectService;
use Exception;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectServiceTest extends TestCase
{
    use RefreshDatabase;
    protected $seed = true;

    public function test_success_provider()
    {
        $projectService1 = $this->app->make(ProjectService::class);
        $projectService2 = $this->app->make(ProjectService::class);

        $this->assertSame($projectService1->getAll(), $projectService2->getAll());
    }

    public function test_success_get_all()
    {
        $projectService = $this->app->make(ProjectService::class);
        $this->assertSame(20, count($projectService->getAll()));
        $this->assertIsArray($projectService->getAll());
        // dump($projectService->getAll());
    }

    public function test_success_create()
    {
        $id = User::inRandomOrder()->first()->id;
        $data = [
            "name" => "StasiunFile",
            "description" => "Contoh description",
            "user_id" => $id
        ];
        $projectService = $this->app->make(ProjectService::class);
        $projectService->create($data);

        $this->assertDatabaseHas("projects", $data);
    }

    // todo add fail creating project

    public function test_success_find_by_id()
    {
        $id = Project::inRandomOrder()->first()->id;
        $projectService = $this->app->make(ProjectService::class);

        $project = $projectService->findById($id);

        $this->assertSame($id, $project['id']);
        $this->assertIsArray($project["project_table"]);
    }

    public function test_fail_find_by_id()
    {
        $id = "f301ab93-1622-4702-853f-278493361600";
        $isError = false;
        $projectService = $this->app->make(ProjectService::class);
        try {
            $projectService->findById($id);
        } catch (Exception $e) {
            $this->assertSame("Project not found", $e->getMessage());
            $this->assertSame(404, $e->getCode());
            $isError = true;
        }

        $this->assertTrue($isError);
    }

    public function test_success_delete_by_id()
    {
        $id = Project::inRandomOrder()->first()->id;
        $this->assertDatabaseHas("projects", [
            "id" => $id
        ]);
        $projectService = $this->app->make(ProjectService::class);

        $this->assertTrue($projectService->deleteById($id));

        $this->assertDatabaseMissing("projects", [
            "id" => $id
        ]);
    }

    public function test_fail_delete_by_id()
    {
        $id = "f301ab93-1622-4702-853f-278493361600";
        $isError = false;
        $projectService = $this->app->make(ProjectService::class);
        try {
            $projectService->deleteById($id);
        } catch (Exception $e) {
            $this->assertTrue($e instanceof ClientException);
            $this->assertSame("Project not found", $e->getMessage());
            $this->assertSame(404, $e->getCode());
            $isError = true;
        }

        $this->assertTrue($isError);
    }

    public function test_success_update_by_id()
    {
        $id = Project::inRandomOrder()->first()->id;
        $projectService = $this->app->make(ProjectService::class);
        $projectService->updateById($id, [
            "name" => "Siapos App",
            "description" => "Siapos adalah aplikasi"
        ]);

        $this->assertDatabaseHas('projects', [
            "name" => "Siapos App",
            "description" => "Siapos adalah aplikasi"
        ]);
    }

    public function test_fail_update_by_id()
    {
        $id = "f301ab93-1622-4702-853f-278493361600";
        $isError = false;
        $projectService = $this->app->make(ProjectService::class);
        try {
            $projectService->updateById($id, ["name" => "Siapos App"]);
        } catch (Exception $e) {
            $this->assertSame("Project not found", $e->getMessage());
            $this->assertSame(404, $e->getCode());
            $isError = true;
        }

        $this->assertDatabaseMissing('projects', ["name" => "Siapos App"]);

        $this->assertTrue($isError);
    }

    public function test_get_all_by_user_id()
    {
        $userId = User::inRandomOrder()->first()->id;
        $projectService =
            $this->app->make(ProjectService::class);
        $projects = $projectService->getAllByUserId($userId);
        $this->assertSame($userId, $projects[0]["user_id"]);
    }
}
