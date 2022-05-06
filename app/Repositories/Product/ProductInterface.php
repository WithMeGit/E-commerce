<?php

namespace App\Repositories\Product;

interface ProductInterface
{
    public function getAll();

    public function getAllBrand();

    public function getAllCategory();

    public function getAllCustomer();

    public function store($request);

    public function update($request, $id);

    public function find($id);

    public function delete($id);
}