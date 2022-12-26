<?php

namespace Database\Seeders;

use App\Models\ColumnType;
use Illuminate\Database\Seeder;

class ColumnTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $columns = [
            [
                "name" => "string"
            ],
            [
                "name" => "array"
            ],
            [
                "name" => "number"
            ],
            [
                "name" => "boolean"
            ],
            [
                "name" => "uuid"
            ]
        ];

        // avoid unique name column
        if (ColumnType::count() < 5) {
            foreach ($columns as $column) {
                ColumnType::create($column);
            }
        }


    }
}
