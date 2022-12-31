<?php

namespace App\Http\Controllers;

use App\Services\Interfaces\ProjectService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private ProjectService $projectService;
    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    /**
     * getAllController
     *
     * @return JsonResponse
     */
    public function getAll(Request $r): JsonResponse
    {
        try {
            $userId = $this->parseCookie($r->cookie("user_id"));
            $data = $this->projectService->getAllByUserId($userId);

            return $this
                ->renderSuccess("Berhasil mengambil data proyek.", $data, 200);
        } catch (Exception $e) {
            return $this->renderError($e);
        }
    }

    public function create(Request $r): JsonResponse
    {
        try {
            $data = $this->projectService->create($r->input());
            return $this
                ->renderSuccess("Berhasil menambah proyek.", $data, 201);
        } catch (Exception $e) {
            return $this->renderError($e);
        }
    }

    public function findById(string $projectId): JsonResponse
    {
        try {
            $data = $this->projectService->findById($projectId);
            return $this
                ->renderSuccess("Berhasil mengambil proyek " . $data["name"], $data, 200);
        } catch (Exception $e) {
            return $this->renderError($e);
        }
    }


    public function update(Request $r, string $projectId): JsonResponse
    {
        try {
            $this->projectService->updateById($projectId, $r->input());
            return $this
                ->renderSuccess("Berhasil mengubah proyek " . $projectId, [], 200);
        } catch (Exception $e) {
            return $this->renderError($e);
        }
    }

    public function delete(string $projectId): JsonResponse
    {
        try {
            $this->projectService->deleteById($projectId);
            return $this
                ->renderSuccess("Berhasil menghapus proyek " . $projectId, [], 200);
        } catch (Exception $e) {
            return $this->renderError($e);
        }
    }
}
