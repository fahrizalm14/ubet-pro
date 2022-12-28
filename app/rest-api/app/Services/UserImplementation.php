<?php

namespace App\Services;

use App\Models\Schedule;
use App\Models\User;
use App\Services\Interfaces\UserService;
use Illuminate\Support\Facades\DB;

class UserImplementation implements UserService
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getProjects(string $id): array
    {
        $_user =
            $this->user
            ->with("project")
            ->where("id", $id)
            ->get()
            ->first();
        if ($_user === null) {
            return [];
        }
        return $_user->toArray();
    }

    public function getSchedules(string $id): array
    {
        $schedules = [];
        $projects = $this->getProjects($id);
        if (sizeof($projects) > 0) {
            $arr = collect($projects["project"])->map(function ($v, $k) {
                $idProject = $v["id"];
                $d =  collect(Schedule::select()
                    ->with("day")
                    ->where("project_id", $idProject)
                    ->get()
                    ->toArray())->map(function ($x, $y) {
                    $day = $x['day']['name'];
                    $x["day"] = $day;
                    return $x;
                });
                return $d;
            });
            $schedules = $arr->flatten(1)->groupBy("day")->toArray();
        }


        return $schedules;
    }
}
