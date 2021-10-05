<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $message = 'Данные загружены';
    /**
     * @param array $data
     * @param string $status
     * @param int $statusCode
     * @return JsonResponse
     */
    protected function responseWithData($data = [], string $status = 'ok', int $statusCode = 200): JsonResponse
    {
        list(, $routeMethod) = explode('@', request()->route()->getActionName());
        $response = [];
        switch ($routeMethod) {
            case 'store':
                $this->setMessage('Ресурс создан');
                $statusCode = 201;
                break;
            case 'update':
                $this->setMessage('Ресурс обновлен');
                break;
            case 'destroy':
                $this->setMessage('Ресурс удален');
                break;
        }
        $response['message'] = $this->message;
        $response['status'] = $status;
        $response['data'] = $data;
        $response['paginator'] = null;
        if ($data instanceof LengthAwarePaginator) {
            $dataArray = $data->toArray();
            $response['data'] = $dataArray['data'];
            unset($dataArray['data']);
            $response['paginator'] = $dataArray;
        }

        return $this->responseWith($response, $statusCode);
    }
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
