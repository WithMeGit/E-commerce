<?php

namespace App\Repositories\Category;

interface CategoryInterface
{
    public function getAll();

    public function find($id);

    public function store($request);

    public function update($request, $id);

    public function delete($id);
}