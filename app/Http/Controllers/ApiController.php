<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Repositories\ProductRepository;
use App\Repositories\CategoryRepository;

class ApiController extends Controller
{

    /**
     * @var ProductRepository
     */
    private $product;


    /**
     * @var CategoryRepository
     */
    private $category;


    /**
     * ApiController constructor.
     * @param ProductRepository $productRepository
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(ProductRepository $productRepository, CategoryRepository $categoryRepository)
    {
        $this->product = $productRepository;
        $this->category = $categoryRepository;
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

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getAllCategory(Request $request): JsonResponse
    {
        try {
            return $this->responseWithData($this->category->all($request->per_page), 200);
        } catch (\Exception $e) {
            return $this->responseWithMessage($e->getMessage(), 'error', 404);
        }

    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getCategory(Request $request): JsonResponse
    {
        try {
            return $this->responseWithData($this->category->get($request->id), 200);
        } catch (\Exception $e) {
            return $this->responseWithMessage($e->getMessage(), 'error', 404);
        }

    }
}
