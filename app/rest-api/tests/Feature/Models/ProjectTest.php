<?php

namespace Tests\Feature\Models;

use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;
    protected $seed = true;
    public function test_factory_model_exist()
    {
        $project = Project::factory()->create();
        $this->assertModelExists($project);
    }

    public function test_project_can_be_created()
    {
        $this->assertDatabaseCount('projects', 20);
    }
}
