<?php

namespace App\Services;

use App\Exceptions\NotFoundException;
use App\Models\ColumnType;
use App\Models\ProjectTable;
use App\Models\TableColumn;
use App\Services\Interfaces\DatabaseDiagramService;

class DatabaseDiagramImplementation implements DatabaseDiagramService
{
    private ProjectTable $projectTable;
    private TableColumn $tableColumn;
    private ColumnType $columnType;

    public function __construct(ProjectTable $projectTable, TableColumn $tableColumn, ColumnType $columnType)
    {
        $this->projectTable = $projectTable;
        $this->tableColumn = $tableColumn;
        $this->columnType = $columnType;
    }

    private function checkProjectTable(string $id)
    {
        $_projectTable = $this->projectTable->find($id);
        if ($_projectTable === null) {
            throw new NotFoundException("Table not found");
        }

        return $_projectTable;
    }

    private function checkTableColumn(string $id)
    {
        $_tableColumn = $this->tableColumn->find($id);
        if ($_tableColumn === null) {
            throw new NotFoundException("Column not found");
        }

        return $_tableColumn;
    }

    public function getProjectTableByProjectId(string $projectId): array
    {
        $_projectTable =
            $this->projectTable
            ->where("project_id", $projectId)
            ->get();

        return $_projectTable->toArray();
    }

    public function getProjectTableById(string $id): array
    {
        $_projectTable =
            $this->projectTable
            ->with('tableColumn')
            ->where('id', $id)
            ->get()
            ->toArray();

        return $_projectTable;
    }

    public function createProjectTable(array $data): array
    {
        $_projectTable = $this->projectTable->create($data);
        return $_projectTable->toArray();
    }

    public function updateProjectTable(string $id, array $data): bool
    {
        return
            $this
            ->checkProjectTable($id)
            ->update($data);
    }

    public function deleteProjectTable(string $id): bool
    {
        $this
            ->checkProjectTable($id)
            ->delete();

        return true;
    }
    // public function getTableColumnByProjectId(string $projectId): array
    // {
    //     return [];
    // }
    public function createTableColumn(array $data): array
    {
        $_tableColumn = $this->tableColumn->create($data);
        return $_tableColumn->toArray();
    }

    public function updateTableColumn(string $id, array $data): bool
    {
        return
            $this
            ->checkTableColumn($id)
            ->update($data);
    }

    public function deleteTableColumn(string $columnId): bool
    {
        return $this
            ->checkTableColumn($columnId)
            ->delete();

        return true;
    }

    public function getAllColumnTypes(): array
    {
        return
            $this
            ->columnType
            ->get()
            ->toArray();
    }
}
