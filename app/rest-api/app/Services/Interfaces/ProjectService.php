<?php

namespace App\Services\Interfaces;

interface ProjectService
{
    public function getAll(): array;
    public function findById(string $id): array;
    public function create(array $data): array;
    public function deleteById(string $id): bool;
    public function updateById(string $id, array $data): bool;
}
