<?php

namespace App\Services;

use App\Exceptions\NotFoundException;
use App\Models\Project;
use App\Services\Interfaces\ProjectService;

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

    public function findById(string $id): array
    {
        $_project = $this->project
            ->with('projectTable', "user")
            ->where('id', $id)
            ->get()
            ->first();

        if ($_project === null) {
            throw new NotFoundException("Project not found");
        }

        return $_project->toArray();
    }

    public function getAll(): array
    {
        return $this->project->get()->toArray();
    }

    public function getAllByUserId(string $userId): array
    {
        return $this
            ->project
            ->where('user_id', $userId)
            ->get()
            ->toArray();
    }

    public function create(array $data): array
    {
        $_project = $this->project->create($data);
        return $_project->toArray();
    }

    public function deleteById(string $id): bool
    {
        $_project = $this->project->find($id);
        if ($_project === null) {
            throw new NotFoundException("Project not found");
        }

        $this->project->find($id)->delete();

        return true;
    }

    public function updateById(string $id, array $data): bool
    {
        $_project = $this->project->find($id);
        if ($_project === null) {
            throw new NotFoundException("Project not found");
        }
        $_project->update($data);
        return true;
    }
}
