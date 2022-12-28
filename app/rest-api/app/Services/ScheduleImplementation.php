<?php

namespace App\Services;

use App\Exceptions\NotFoundException;
use App\Models\Day;
use App\Models\Schedule;
use App\Services\Interfaces\ScheduleService;

class ScheduleImplementation implements ScheduleService
{

    private Day $day;
    private Schedule $schedule;

    public function __construct(Schedule $schedule, Day $day)
    {
        $this->day = $day;
        $this->schedule = $schedule;
    }

    private function checkSchedule(string $id)
    {
        $_schedule = $this->schedule->find($id);
        if ($_schedule === null) {
            throw new NotFoundException("Schedule not found");
        }

        return $_schedule;
    }

    public function getAllDay(): array
    {
        return $this->day->get()->toArray();
    }

    public function create(array $data): array
    {
        $_schedule = $this->schedule->create($data);
        return $_schedule->toArray();
    }

    public function deleteById(string $id): bool
    {
        $s = $this->checkSchedule($id);
        $s->delete();

        return true;
    }

    public function activate(string $id): bool
    {
        $s = $this->checkSchedule($id);
        $s->update([
            "is_done" => true
        ]);

        return true;
    }

    public function deactivate(string $id): bool
    {
        $s = $this->checkSchedule($id);
        $s->update([
            "is_done" => false
        ]);

        return true;
    }
}
