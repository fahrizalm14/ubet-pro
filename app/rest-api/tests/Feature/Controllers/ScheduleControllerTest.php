<?php

namespace Tests\Feature\Controllers;

use App\Models\Day;
use App\Models\Project;
use App\Models\Schedule;
use App\Models\User;

class ScheduleControllerTest extends ControllerTest
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_all_days()
    {
        $response = $this->withCookie(
            "user_id",
            User::inRandomOrder()->first()->id
        )->get("/api/schedules/days");

        $this->_response_withData($response);
        $response->assertStatus(200);
        $this->assertSame(7, sizeof($response["data"]));
    }

    public function test_create_schedule()
    {
        $data = [
            "project_id" => Project::inRandomOrder()->first()->id,
            "day_id" => Day::inRandomOrder()->first()->id,
            "start_time" => "19:30",
            "end_time" => "11:30",
            "is_done" => true
        ];

        $response = $this->withCookie(
            "user_id",
            User::inRandomOrder()->first()->id
        )->post("/api/schedules", $data);

        $this->_response_withData($response);
        $response->assertStatus(201);
        $this->assertDatabaseHas("schedules", $data);
    }

    public function test_delete_schedule()
    {
        $id = Schedule::inRandomOrder()->first()->id;
        $response = $this->withCookie(
            "user_id",
            User::inRandomOrder()->first()->id
        )->delete("/api/schedules/" . $id);

        $this->_response_withData($response);
        $response->assertStatus(200);
        $this->assertDatabaseMissing("schedules", [
            "id" => $id
        ]);
    }

    public function test_activate_schedule()
    {
        $id = Schedule::inRandomOrder()->first()->id;
        $response = $this->withCookie(
            "user_id",
            User::inRandomOrder()->first()->id
        )->put("/api/schedules/" . $id . "/activate");

        $this->_response_withData($response);
        $response->assertStatus(200);

        $schedule = Schedule::find($id)->toArray();
        $this->assertTrue($schedule["is_done"]);
    }

    public function test_deactivate_schedule()
    {
        $id = Schedule::inRandomOrder()->first()->id;
        $response = $this->withCookie(
            "user_id",
            User::inRandomOrder()->first()->id
        )->put("/api/schedules/" . $id . "/deactivate");

        $this->_response_withData($response);
        $response->assertStatus(200);

        $schedule = Schedule::find($id)->toArray();
        $this->assertFalse($schedule["is_done"]);
    }
}
