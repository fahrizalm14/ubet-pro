<?php

namespace Database\Factories;

use App\Models\Day;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Schedule>
 */
class ScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "title" => $this->faker->title(),
            "project_id" => Project::inRandomOrder()->first()->id,
            "day_id" => Day::inRandomOrder()->first()->id,
            "start_time" => $this->faker->randomNumber(2),
            "end_time" => $this->faker->randomNumber(2),
            "is_done" => $this->faker->boolean()
        ];
    }
}
