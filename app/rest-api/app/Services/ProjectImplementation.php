<?php

namespace App\Services;

use App\Models\Project;
use App\Services\Interfaces\ProjectService;
use Illuminate\Database\Eloquent\Collection;

class ProjectImplementation implements ProjectService
{
    private Project $project;

    /**
     * @param mixed $project
     */

    //  auto inject without create new instance Project
    public function __construct(Project $project)
    {
        $this->project = $project;
    }

    private function getCollection()
    {
        return collect($this->getAll());
    }

    public function findById(string $id)
    {
        $project = $this->project::get();
        var_dump($project);
        return $project;
    }

    public function getAll(): array
    {
        return $this->project::get()->toArray();
    }

    public function toJson()
    {
        return $this->getCollection()->toJson();
    }


}
