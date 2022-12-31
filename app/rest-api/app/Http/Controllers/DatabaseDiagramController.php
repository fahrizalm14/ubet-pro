<?php

namespace App\Http\Controllers;

use App\Services\Interfaces\DatabaseDiagramService;
use Exception;
use Illuminate\Http\Request;

class DatabaseDiagramController extends Controller
{
    private DatabaseDiagramService $databaseDiagramService;

    /**
     * @param DatabaseDiagramService $databaseDiagramService
     */
    public function __construct(DatabaseDiagramService $databaseDiagramService)
    {
        $this->databaseDiagramService = $databaseDiagramService;
    }

    public function getDatabaseByProjectId(string $projectId)
    {

        try {
            $data = $this
                ->databaseDiagramService
                ->getProjectTableByProjectId($projectId);
            return $this
                ->renderSuccess(
                    "Berhasil mengambil database.",
                    $data,
                    200
                );
        } catch (Exception $e) {
            return $this->renderError($e);
        }
    }

    public function getDatabaseTable(string $id)
    {

        try {
            $data = $this
                ->databaseDiagramService
                ->getProjectTableById($id);
            return $this
                ->renderSuccess(
                    "Berhasil mengambil tabel.",
                    $data,
                    200
                );
        } catch (Exception $e) {
            return $this->renderError($e);
        }
    }

    public function createDatabaseTable(Request $r)
    {

        try {
            $data = $this
                ->databaseDiagramService
                ->createProjectTable($r->input());
            return $this
                ->renderSuccess(
                    "Berhasil membuat tabel baru.",
                    $data,
                    201
                );
        } catch (Exception $e) {
            return $this->renderError($e);
        }
    }

    public function updateDatabaseTable(Request $r, string $tableId)
    {

        try {
            $this
                ->databaseDiagramService
                ->updateProjectTable($tableId, $r->input());
            return $this
                ->renderSuccess(
                    "Berhasil mengubah tabel.",
                    [],
                    200
                );
        } catch (Exception $e) {
            return $this->renderError($e);
        }
    }

    public function deleteDatabaseTable(string $tableId)
    {

        try {
            $this
                ->databaseDiagramService
                ->deleteProjectTable($tableId);
            return $this
                ->renderSuccess(
                    "Berhasil mengahpus tabel.",
                    [],
                    200
                );
        } catch (Exception $e) {
            return $this->renderError($e);
        }
    }

    public function getAllDatabaseColumnType()
    {

        try {
            $data = $this
                ->databaseDiagramService
                ->getAllColumnTypes();
            return $this
                ->renderSuccess(
                    "Berhasil mengambil jenis kolom tabel.",
                    $data,
                    200
                );
        } catch (Exception $e) {
            return $this->renderError($e);
        }
    }

    public function createDatabaseColumn(Request $r)
    {

        try {
            $data = $this
                ->databaseDiagramService
                ->createTableColumn($r->input());
            return $this
                ->renderSuccess(
                    "Berhasil membuat kolom baru.",
                    $data,
                    201
                );
        } catch (Exception $e) {
            return $this->renderError($e);
        }
    }

    public function updateDatabaseColumn(Request $r, string $columnId)
    {

        try {
            $data = $this
                ->databaseDiagramService
                ->updateTableColumn($columnId, $r->input());
            return $this
                ->renderSuccess(
                    "Berhasil mengambil tabel.",
                    [$data],
                    200
                );
        } catch (Exception $e) {
            return $this->renderError($e);
        }
    }

    public function deleteDatabaseColumn(string $columnId)
    {
        try {
            $data = $this
                ->databaseDiagramService
                ->deleteTableColumn($columnId);
            return $this
                ->renderSuccess(
                    "Berhasil menghaus kolom.",
                    [$data],
                    200
                );
        } catch (Exception $e) {
            return $this->renderError($e);
        }
    }
}
