<?php

namespace App\Repositories\Brand;

interface BrandInterface
{
    public function getAll();

    public function getAllCategory();

    public function find($id);

    public function store($request);

    public function update($request, $id);

    public function delete($id);
}