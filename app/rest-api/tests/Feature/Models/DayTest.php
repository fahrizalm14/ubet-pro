<?php

namespace Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DayTest extends TestCase
{
    use RefreshDatabase;
    protected $seed = true;
    public function test_day_must_be_has_value_from_seeder()
    {
        $this->assertDatabaseHas('days', [
            'name' => 'Monday',
        ]);
        $this->assertDatabaseHas('days', [
            'name' => 'Tuesday',
        ]);
        $this->assertDatabaseHas('days', [
            'name' => 'Wednesday',
        ]);
        $this->assertDatabaseHas('days', [
            'name' => 'Thursday',
        ]);
        $this->assertDatabaseHas('days', [
            'name' => 'Friday',
        ]);
        $this->assertDatabaseHas('days', [
            'name' => 'Saturday',
        ]);
        $this->assertDatabaseHas('days', [
            'name' => 'Sunday',
        ]);
    }
}
