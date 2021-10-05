<?php


namespace App\Repositories\Interfaces;


interface BaseInterface
{
    public function all($per_page);
    public function get($id);
}
