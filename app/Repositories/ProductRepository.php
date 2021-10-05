<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Interfaces\BaseInterface;

class ProductRepository implements BaseInterface
{


    /**
     * @param $id
     * @return array
     */
    public function get($id): array
    {
        $products = Product::find($id);
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
