<?php

namespace App\Http\Controllers;

use App\Services\Interfaces\UserService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private UserService $userService;

    /**
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function getProjects(Request $r): JsonResponse
    {
        try {
            $userId = $this->parseCookie($r->cookie("user_id"));
            $data = $this->userService->getProjects($userId);

            return $this
                ->renderSuccess("Berhasil mengambil data proyek.", $data, 200);
        } catch (Exception $e) {
            return $this->renderError($e);
        }
    }

    public function getSchedules(Request $r): JsonResponse
    {
        try {
            $userId = $this->parseCookie($r->cookie("user_id"));
            $data = $this->userService->getSchedules($userId);

            return $this
                ->renderSuccess("Berhasil mengambil data jadwal.", $data, 200);
        } catch (Exception $e) {
            return $this->renderError($e);
        }
    }
}
