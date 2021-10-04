<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        try {
            $products = Product::find($request->id);
            $response['id'] = $products->id;
            $response['name'] = $products->name;
            $response['category'] = $products->category;

            return $this->responseWith($response, 200);
        } catch (\Exception $e) {
            return $this->responseWithMessage($e->getMessage(), 'error', 404);
        }

    }
}
