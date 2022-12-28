<?php

namespace Tests\Feature;

use App\Exceptions\ClientException;
use App\Models\Day;
use App\Models\Project;
use App\Models\Schedule;
use App\Services\Interfaces\ScheduleService;
use Exception;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ScheduleServiceTest extends TestCase
{
    use RefreshDatabase;
    protected $seed = true;

    public function test_success_provider()
    {
        $scheduleService1 =
            $this->app->make(ScheduleService::class);
        $scheduleService2 =
            $this->app->make(ScheduleService::class);

        $this->assertSame(
            $scheduleService1->getAllDay(),
            $scheduleService2->getAllDay()
        );
    }

    public function test_should_have_day_data_seeder()
    {
        $schedule = $this->app->make(ScheduleService::class);
        $days = $schedule->getAllDay();

        $this->assertSame(7, sizeof($days));
    }

    public function test_success_create()
    {
        $data = [
            "project_id" => Project::inRandomOrder()->first()->id,
            "day_id" => Day::inRandomOrder()->first()->id,
            "start_time" => "09:30",
            "end_time" => "10:30",
            "is_done" => false
        ];
        $scheduleService =
            $this->app->make(ScheduleService::class);
        $scheduleService->create($data);

        $this->assertDatabaseHas("schedules", $data);
    }

    // todo add fail creating project

    public function test_success_delete_by_id()
    {
        $id = Schedule::inRandomOrder()->first()->id;
        $this->assertDatabaseHas("schedules", [
            "id" => $id
        ]);
        $scheduleService = $this->app->make(ScheduleService::class);

        $this->assertTrue($scheduleService->deleteById($id));

        $this->assertDatabaseMissing("schedules", [
            "id" => $id
        ]);
    }


    public function test_fail_delete_by_id()
    {
        $id = "f301ab93-1622-4702-853f-278493361600";
        $isError = false;
        $scheduleService = $this->app->make(ScheduleService::class);
        try {
            $scheduleService->deleteById($id);
        } catch (Exception $e) {
            $this->assertTrue($e instanceof ClientException);
            $this->assertSame("Schedule not found", $e->getMessage());
            $this->assertSame(404, $e->getCode());
            $isError = true;
        }

        $this->assertTrue($isError);
    }

    public function test_success_activate_by_id()
    {
        $id = Schedule::inRandomOrder()->first()->id;
        $scheduleService = $this->app->make(ScheduleService::class);
        $activate = $scheduleService->activate($id);

        $schedule = Schedule::find($id)->toArray();

        $this->assertTrue($activate);
        $this->assertTrue($schedule["is_done"]);
    }

    public function test_fail_activate_by_id()
    {
        $id = "f301ab93-1622-4702-853f-278493361600";
        $isError = false;
        $scheduleService = $this->app->make(ScheduleService::class);
        try {
            $scheduleService->activate($id);
        } catch (Exception $e) {
            $this->assertTrue($e instanceof ClientException);
            $this->assertSame("Schedule not found", $e->getMessage());
            $this->assertSame(404, $e->getCode());
            $isError = true;
        }

        $this->assertTrue($isError);
    }

    public function test_success_deactivate_by_id()
    {
        $id = Schedule::inRandomOrder()->first()->id;
        $scheduleService = $this->app->make(ScheduleService::class);
        $activate = $scheduleService->deactivate($id);

        $schedule = Schedule::find($id)->toArray();

        $this->assertTrue($activate);
        $this->assertFalse($schedule["is_done"]);
    }


    public function test_fail_deactivate_by_id()
    {
        $id = "f301ab93-1622-4702-853f-278493361600";
        $isError = false;
        $scheduleService = $this->app->make(ScheduleService::class);
        try {
            $scheduleService->deactivate($id);
        } catch (Exception $e) {
            $this->assertTrue($e instanceof ClientException);
            $this->assertSame("Schedule not found", $e->getMessage());
            $this->assertSame(404, $e->getCode());
            $isError = true;
        }

        $this->assertTrue($isError);
    }
}
