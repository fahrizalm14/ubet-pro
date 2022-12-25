<?php

namespace Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ColumnTypeTest extends TestCase
{
    use RefreshDatabase;
    protected $seed = true;
    public function test_column_type_must_be_has_value_from_seeder()
    {
        $this->assertDatabaseHas('column_types', [
            'name' => 'string',
        ]);
        $this->assertDatabaseHas('column_types', [
            'name' => 'array',
        ]);
        $this->assertDatabaseHas('column_types', [
            'name' => 'number',
        ]);
        $this->assertDatabaseHas('column_types', [
            'name' => 'boolean',
        ]);
        $this->assertDatabaseHas('column_types', [
            'name' => 'uuid',
        ]);
    }
}
