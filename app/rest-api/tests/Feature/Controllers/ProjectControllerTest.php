<?php

namespace Tests\Feature\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectControllerTest extends ControllerTest
{
    use RefreshDatabase;
    protected $seed = true;

    public function test_success_get_all_projects()
    {
        $response = $this->withCookie(
            "user_id",
            User::inRandomOrder()->first()->id
        )->get('/api/projects');

        $this->_response_withData($response);

        $response->assertStatus(200);
        $this->assertArrayHasKey("id", $response["data"][0]);
        $this->assertArrayHasKey("name", $response["data"][0]);
        $this->assertArrayHasKey("description", $response["data"][0]);
        // dump($response);
    }

    public function test_success_project_find_by_id()
    {
        $id = Project::inRandomOrder()->first()->id;

        $response = $this->withCookie(
            "user_id",
            User::inRandomOrder()->first()->id
        )->get('/api/projects/' . $id);
        $response->assertStatus(200);
        $this->_response_withData($response);
    }

    public function test_success_create_project()
    {
        $id = Project::inRandomOrder()->first()->id;
        $data = [
            "name" => "StasiunFileXXXXXAdadadafasf",
            "description" => "Contoh desAFASFASFASFASFScription",
        ];
        $response = $this->withCookie(
            "user_id",
            User::inRandomOrder()->first()->id
        )->post('/api/projects', $data);
        $response->assertStatus(201);
        $this->_response_withData($response);
        $this->assertDatabaseHas("projects", $data);
    }

    public function test_success_update_project()
    {
        $id = Project::inRandomOrder()->first()->id;
        $data = [
            "name" => "Siapos App",
            "description" => "Siapos adalah aplikasi"
        ];
        $response = $this->withCookie(
            "user_id",
            User::inRandomOrder()->first()->id
        )->put('/api/projects/' . $id, $data);

        $response->assertStatus(200);
        $this->_response_withData($response);

        $this->assertDatabaseHas('projects', [
            "name" => "Siapos App",
            "description" => "Siapos adalah aplikasi"
        ]);
    }

    public function test_success_delete_project()
    {
        $id = Project::inRandomOrder()->first()->id;
        $response = $this->withCookie(
            "user_id",
            User::inRandomOrder()->first()->id
        )->delete('/api/projects/' . $id);

        $response->assertStatus(200);
        $this->_response_withData($response);

        $this->assertDatabaseMissing("projects", [
            "id" => $id
        ]);
    }
}
