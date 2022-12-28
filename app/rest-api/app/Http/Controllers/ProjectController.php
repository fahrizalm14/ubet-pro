<?php

namespace App\Http\Controllers;

use App\Exceptions\ClientException;
use App\Models\Project;
use App\Services\Interfaces\ProjectService;
use Exception;
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

    public function getAllController()
    {
        try {
            $data = $this->projectService->getAll();

            return response()->json($data, 200);
        } catch (Exception $e) {
            if ($e instanceof ClientException) {
                return response()->json([
                    "message" => $e->getMessage()
                ], $e->getCode());
            }

            return response()->json([
                "message" => "Server error"
            ], 500);
        }
    }
}
