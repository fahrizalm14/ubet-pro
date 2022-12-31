<?php

namespace Database\Seeders;

use App\Models\TableColumn;
use Illuminate\Database\Seeder;

class TableColumnSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TableColumn::factory(120)->create();
    }
}
