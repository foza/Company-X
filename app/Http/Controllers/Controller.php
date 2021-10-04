<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param array $response
     * @param int $statusCode
     * @return JsonResponse
     */
    protected function responseWith(array $response, int $statusCode): JsonResponse
    {
        return response()->json($response)->setStatusCode($statusCode);
    }

    /**
     * @param string $message
     * @param string $status
     * @param int $statusCode
     * @return JsonResponse
     */
    protected function responseWithMessage(string $message, string $status = 'ok', int $statusCode = 200): JsonResponse
    {
        $response = [
            'status' => $status,
            'message' => $message,
        ];

        return $this->responseWith($response, $statusCode);
    }
}
