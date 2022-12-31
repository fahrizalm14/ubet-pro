<?php

namespace Tests\Feature;

use App\Models\ColumnType;
use App\Models\Project;
use App\Models\ProjectTable;
use App\Models\TableColumn;
use App\Services\Interfaces\DatabaseDiagramService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DatabaseDiagramServiceTest extends TestCase
{
    use RefreshDatabase;
    protected $seed = true;
    public function test_success_provider()
    {
        $databaseDiagramService1 =
            $this->app->make(DatabaseDiagramService::class);
        $databaseDiagramService2 =
            $this->app->make(DatabaseDiagramService::class);

        $this->assertSame(
            $databaseDiagramService1->getAllColumnTypes(),
            $databaseDiagramService2->getAllColumnTypes()
        );
    }

    public function test_success_get_project_table_by_project_id()
    {
        $projectId = Project::inRandomOrder()->first()->id;
        $databaseDiagramService =
            $this->app->make(DatabaseDiagramService::class);
        $databases = $databaseDiagramService->getProjectTableByProjectId($projectId);
        $this->assertSame($projectId, $databases[0]["project_id"]);
        $this->assertIsArray($databases);
    }

    public function test_success_get_project_table_by_id()
    {
        $id = ProjectTable::inRandomOrder()->first()->id;
        $databaseDiagramService =
            $this->app->make(DatabaseDiagramService::class);
        $databases = $databaseDiagramService->getProjectTableById($id);
        $this->assertIsArray($databases);
    }

    public function test_success_get_project_table_by_id_is_not_found()
    {
        $id = "346e10a1-cf2c-4d0a-97c3-a28b821abdd4";
        $databaseDiagramService =
            $this->app->make(DatabaseDiagramService::class);
        $databases = $databaseDiagramService->getProjectTableById($id);
        $this->assertIsArray($databases);
        $this->assertSame([], $databases);
    }

    public function test_success_create_project_table()
    {
        $data = [
            "name" => "User",
            "project_id" => Project::inRandomOrder()->first()->id
        ];

        $databaseDiagramService =
            $this->app->make(DatabaseDiagramService::class);

        $creating = $databaseDiagramService->createProjectTable($data);
        $this->assertSame($data["name"], $creating["name"]);
        $this->assertSame($data["project_id"], $creating["project_id"]);
        $this->assertDatabaseHas("project_tables", $data);
    }

    public function test_success_update_project_table_by_id()
    {
        $id =  ProjectTable::inRandomOrder()->first()->id;
        $data = [
            "name" => "User Update"
        ];
        $databaseDiagramService = $this->app->make(DatabaseDiagramService::class);
        $update = $databaseDiagramService->updateProjectTable($id, $data);

        $this->assertDatabaseHas('project_tables', $data);
        $this->assertTrue($update);
    }

    // todo test fail update project table by id

    public function test_success_delete_project_table_by_id()
    {
        $id = ProjectTable::inRandomOrder()->first()->id;
        $this->assertDatabaseHas("project_tables", [
            "id" => $id
        ]);
        $scheduleService = $this->app->make(DatabaseDiagramService::class);

        $this->assertTrue($scheduleService->deleteProjectTable($id));

        $this->assertDatabaseMissing("project_tables", [
            "id" => $id
        ]);
    }


    public function test_success_create_table_column()
    {
        $data = [
            "name" => "Field",
            "length" => 25,
            "project_table_id" => ProjectTable::inRandomOrder()->first()->id,
            "column_type_id" => ColumnType::inRandomOrder()->first()->id,
            "is_primary" => true,
            "alias" => "alias"
        ];

        $databaseDiagramService =
            $this->app->make(DatabaseDiagramService::class);

        $creating = $databaseDiagramService->createTableColumn($data);
        $this->assertSame($data["name"], $creating["name"]);
        $this->assertSame($data["length"], $creating["length"]);
        $this->assertSame($data["project_table_id"], $creating["project_table_id"]);
        $this->assertSame($data["column_type_id"], $creating["column_type_id"]);
        $this->assertSame($data["is_primary"], $creating["is_primary"]);
        $this->assertSame($data["alias"], $creating["alias"]);
        $this->assertDatabaseHas("table_columns", $data);
    }

    public function test_success_update_table_column_by_id()
    {
        $id =  TableColumn::inRandomOrder()->first()->id;
        $data = [
            "name" => "Field",
            "length" => 25,
            "project_table_id" => ProjectTable::inRandomOrder()->first()->id,
            "column_type_id" => ColumnType::inRandomOrder()->first()->id,
            "is_primary" => false,
            "alias" => "alias update"
        ];
        $databaseDiagramService = $this->app->make(DatabaseDiagramService::class);
        $update = $databaseDiagramService->updateTableColumn($id, $data);

        $this->assertDatabaseHas('table_columns', $data);
        $this->assertTrue($update);
    }

    public function test_success_delete_table_column_by_id()
    {
        $id = TableColumn::inRandomOrder()->first()->id;
        $this->assertDatabaseHas("table_columns", [
            "id" => $id
        ]);
        $scheduleService = $this->app->make(DatabaseDiagramService::class);

        $this->assertTrue($scheduleService->deleteTableColumn($id));

        $this->assertDatabaseMissing("table_columns", [
            "id" => $id
        ]);
    }

    public function test_success_get_column_types()
    {
        $scheduleService = $this->app->make(DatabaseDiagramService::class);
        $this->assertSame(5, count($scheduleService->getAllColumnTypes()));
        $this->assertIsArray($scheduleService->getAllColumnTypes());
    }
}
