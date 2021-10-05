<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Interfaces\ProductInterface;

class ProductRepository implements ProductInterface
{


    /**
     * @param $productId
     * @return array
     */
    public function get($productId): array
    {
        $products = Product::find($productId);
        $response['id'] = $products->id;
        $response['name'] = $products->name;
        $response['category'] = $products->category;
        return $response;
    }

    /**
     * @param $per_page
     * @return mixed
     */
    public function all($per_page)
    {
        return Product::paginate($per_page);
    }
}
