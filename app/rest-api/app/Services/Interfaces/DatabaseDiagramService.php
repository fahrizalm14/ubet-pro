<?php

namespace App\Services\Interfaces;

interface DatabaseDiagramService
{
    public function getProjectTableByProjectId(string $projectId): array;
    public function getProjectTableById(string $id): array;
    public function createProjectTable(array $data): array;
    public function updateProjectTable(string $id, array $data): bool;
    public function deleteProjectTable(string $id): bool;
    // public function getTableColumnByProjectId(string $projectId): array;
    public function createTableColumn(array $data): array;
    public function updateTableColumn(string $id, array $data): bool;
    public function deleteTableColumn(string $columnId): bool;
    public function getAllColumnTypes(): array;
}
