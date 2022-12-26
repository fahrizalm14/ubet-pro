<?php

namespace Database\Seeders;

use App\Models\Day;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $days = [
            [
                "name" => "Monday"
            ],
            [
                "name" => "Tuesday"
            ],
            [
                "name" => "Wednesday"
            ],
            [
                "name" => "Thursday"
            ],
            [
                "name" => "Friday"
            ],
            [
                "name" => "Saturday"
            ],
            [
                "name" => "Sunday"
            ],
        ];

        // avoid unique name day
        if (Day::count() < 7) {
            foreach ($days as $day) {
                Day::create($day);
            }
        }
    }
}
