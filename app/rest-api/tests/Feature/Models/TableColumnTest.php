<?php

namespace Tests\Feature\Models;

use App\Models\TableColumn;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TableColumnTest extends TestCase
{
    use RefreshDatabase;
    protected $seed = true;
    public function test_factory_model_exist()
    {
        $tableColumn = TableColumn::factory()->create();
        $this->assertModelExists($tableColumn);
    }

    public function test_table_column_can_be_created()
    {
        $this->assertDatabaseCount('table_columns', 120);
    }
}
