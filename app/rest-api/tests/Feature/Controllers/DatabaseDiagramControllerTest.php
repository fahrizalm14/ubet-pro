<?php

namespace Tests\Feature\Controllers;

use App\Models\ColumnType;
use App\Models\Project;
use App\Models\ProjectTable;
use App\Models\TableColumn;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DatabaseDiagramControllerTest extends ControllerTest
{

    use RefreshDatabase;
    protected $seed = true;
    public function test_get_all_database_by_project_id()
    {
        $projectId = Project::inRandomOrder()->first()->id;

        $response = $this->withCookie(
            "user_id",
            User::inRandomOrder()->first()->id
        )->get("/api/databases/" . $projectId);


        $this->_response_withData($response);
        $response->assertStatus(200);
        $this->assertSame($projectId, $response["data"][0]["project_id"]);
    }

    public function test_get_database_table_by_id()
    {
        $tableId = ProjectTable::inRandomOrder()->first()->id;

        $response = $this->withCookie(
            "user_id",
            User::inRandomOrder()->first()->id
        )->get("/api/databases/tables/" . $tableId);

        $this->_response_withData($response);
        $response->assertStatus(200);
        $this->assertSame($tableId, $response["data"][0]["id"]);
        $this->assertSame($tableId, $response["data"][0]["table_column"][0]["project_table_id"]);
    }

    public function test_create_database_table()
    {
        $data = [
            "name" => "Payment",
            "project_id" => Project::inRandomOrder()->first()->id
        ];
        $response = $this->withCookie(
            "user_id",
            User::inRandomOrder()->first()->id
        )->post("/api/databases/tables", $data);
        $response->assertStatus(201);
        $this->_response_withData($response);
        $this->assertDatabaseHas("project_tables", $data);
    }

    public function test_update_database_table()
    {
        $tableId = ProjectTable::inRandomOrder()->first()->id;
        $data = [
            "name" => "Payment update",
        ];
        $response = $this->withCookie(
            "user_id",
            User::inRandomOrder()->first()->id
        )->put("/api/databases/tables/" . $tableId, $data);
        $response->assertStatus(200);
        $this->_response_withData($response);
        $this->assertDatabaseHas("project_tables", $data);
    }

    public function test_delete_database_table()
    {
        $tableId = ProjectTable::inRandomOrder()->first()->id;
        $response = $this->withCookie(
            "user_id",
            User::inRandomOrder()->first()->id
        )->delete("/api/databases/tables/" . $tableId);
        $response->assertStatus(200);
        $this->_response_withData($response);
        $this->assertDatabaseMissing("project_tables", [
            "id" => $tableId
        ]);
    }

    public function test_get_all_database_column_type()
    {
        $response = $this->withCookie(
            "user_id",
            User::inRandomOrder()->first()->id
        )->get("/api/databases/columns/type");
        $response->assertStatus(200);
        $this->_response_withData($response);
        $this->assertSame(5, count($response["data"]));
        $this->assertIsArray($response["data"]);
    }

    public function test_create_database_column()
    {
        $data = [
            "name" => "Field New",
            "length" => 25,
            "project_table_id" => ProjectTable::inRandomOrder()->first()->id,
            "column_type_id" => ColumnType::inRandomOrder()->first()->id,
            "is_primary" => true,
            "alias" => "alias"
        ];

        $response = $this->withCookie(
            "user_id",
            User::inRandomOrder()->first()->id
        )->post("/api/databases/columns", $data);
        $response->assertStatus(201);
        $this->_response_withData($response);
        $this->assertIsArray($response["data"]);

        $this->assertSame($data["name"], $response["data"]["name"]);
        $this->assertSame($data["length"], $response["data"]["length"]);
        $this->assertSame($data["project_table_id"], $response["data"]["project_table_id"]);
        $this->assertSame($data["column_type_id"], $response["data"]["column_type_id"]);
        $this->assertSame($data["is_primary"], $response["data"]["is_primary"]);
        $this->assertSame($data["alias"], $response["data"]["alias"]);
        $this->assertDatabaseHas("table_columns", $data);
    }

    public function test_update_database_column()
    {
        $id = TableColumn::inRandomOrder()->first()->id;
        $data = [
            "name" => "Field Update",
            "length" => 125,
            "is_primary" => false,
            "alias" => "alias update"
        ];

        $response = $this->withCookie(
            "user_id",
            User::inRandomOrder()->first()->id
        )->put("/api/databases/columns/" . $id, $data);
        $response->assertStatus(200);
        $this->_response_withData($response);
        $this->assertIsArray($response["data"]);

        $this->assertDatabaseHas("table_columns", $data);
    }





    public function test_delete_database_column()
    {

        $id = TableColumn::inRandomOrder()->first()->id;
        $response = $this->withCookie(
            "user_id",
            User::inRandomOrder()->first()->id
        )->delete("/api/databases/columns/" . $id);
        $response->assertStatus(200);
        $this->_response_withData($response);
        $this->assertDatabaseMissing("table_columns", [
            "id" => $id
        ]);
    }
}
