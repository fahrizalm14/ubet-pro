<?php

namespace Database\Factories;

use App\Models\ColumnType;
use App\Models\ProjectTable;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TableColumn>
 */
class TableColumnFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "name" => $this->faker->monthName(),
            "length" => $this->faker->randomNumber(3),
            "project_table_id" => ProjectTable::inRandomOrder()->first()->id,
            "column_type_id" => ColumnType::inRandomOrder()->first()->id,
            "is_primary" => $this->faker->boolean(),
            "alias" => $this->faker->lastName()
        ];
    }
}
