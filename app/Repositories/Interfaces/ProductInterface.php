<?php


namespace App\Repositories\Interfaces;


interface ProductInterface
{
    public function all($per_page);
    public function get($productId);
}
