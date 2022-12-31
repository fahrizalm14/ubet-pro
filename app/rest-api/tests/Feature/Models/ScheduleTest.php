<?php

namespace Tests\Feature\Models;

use App\Models\Schedule;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ScheduleTest extends TestCase
{
    use RefreshDatabase;

    public function test_factory_model_exist()
    {
        $schedule = Schedule::factory()->create();
        $this->assertModelExists($schedule);
    }

    public function test_schedule_can_be_created()
    {
        $this->assertDatabaseCount('schedules', 120);
    }
}
