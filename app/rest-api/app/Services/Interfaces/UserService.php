<?php

namespace App\Services\Interfaces;

interface UserService
{
    public function getProjects(string $id): array;
    public function getSchedules(string $id): array;
}
