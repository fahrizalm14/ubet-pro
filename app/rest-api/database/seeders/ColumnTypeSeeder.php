<?php

namespace Database\Seeders;

use App\Models\ColumnType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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

        foreach ($columns as $column) {
            ColumnType::create($column);
        }
    }
}
