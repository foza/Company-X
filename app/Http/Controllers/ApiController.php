<?php

namespace App\Http\Controllers;


use App\Repositories\ProductRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiController extends Controller
{

    /**
     * @var ProductRepository
     */
    private $product;

    public function __construct(ProductRepository $productRepository)
    {
        $this->product = $productRepository;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getProduct(Request $request): JsonResponse
    {
        try {
            return $this->responseWith($this->product->get($request->id), 200);
        } catch (\Exception $e) {
            return $this->responseWithMessage($e->getMessage(), 'error', 404);
        }

    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getAllProduct(Request $request): JsonResponse
    {
        try {
            return $this->responseWithData($this->product->all($request->per_page), 200);
        } catch (\Exception $e) {
            return $this->responseWithMessage($e->getMessage(), 'error', 404);
        }

    }
}
