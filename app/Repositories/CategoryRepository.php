<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\Interfaces\BaseInterface;

class CategoryRepository implements BaseInterface
{


    /**
     * @param $id
     * @return mixed
     */
    public function get($id)
    {
        return Category::find($id);
    }

    /**
     * @param $per_page
     * @return mixed
     */
    public function all($per_page)
    {
        return Category::paginate($per_page);
    }
}
