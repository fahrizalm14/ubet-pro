<?php

namespace App\Http\Controllers;

use App\Exceptions\ClientException;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * renderSuccess
     *
     * @param  string $message
     * @param  array $data
     * @param  int $statusCode
     * @return JsonResponse
     */
    public function renderSuccess(string $message, array $data, int $statusCode): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data
        ], $statusCode);
    }

    /**
     * renderError
     *
     * @param  Exception $e
     * @return JsonResponse
     */
    public function renderError(Exception $e): JsonResponse
    {

        if ($e instanceof ClientException) {
            return response()->json([
                'success' => false,
                "message" => $e->getMessage()
            ], $e->getCode());
        }

        dump($e);
        return response()->json([
            'success' => false,
            "message" => "Server error"
        ], 500);
    }

    public function parseCookie(string $cookie)
    {

        $userId = $cookie;

        if (strlen($userId > 36)) {

            $array = explode('|', decrypt($userId, false));
            $userId = $array[1];
        }

        return $userId;
    }
}
