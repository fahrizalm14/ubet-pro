<?php

namespace App\Services\Interfaces;

interface ScheduleService
{
    public function getAllDay(): array;
    public function create(array $data): array;
    public function deleteById(string $id): bool;
    public function activate(string $id): bool;
    public function deactivate(string $id): bool;
}
