<?php

namespace Tests\Feature\Models;

use App\Models\ProjectTable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectTableTest extends TestCase
{
    use RefreshDatabase;
    protected $seed = true;

    public function test_factory_model_exist()
    {
        $projectTable = ProjectTable::factory()->create();
        $this->assertModelExists($projectTable);
    }

    public function test_project_table_can_be_created()
    {
        $this->assertDatabaseCount('project_tables', 60);
    }
}
