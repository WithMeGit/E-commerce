<?php

namespace App\Repositories\Product;

use App\Repositories\RepositoryInterface;

interface ProductInterface extends RepositoryInterface
{
    public function getAllProductActive($number);

    public function getAllProductActiveRandom($number);

    public function getAllBrand();

    public function getBrandWithProductByID($id);

    public function getCategoryWithProductByID($id);

    public function getAllCategory();

    public function getAllCustomer();

    public function getCategoryByName($name);

    public function getBrandByName($name);

    public function getProductByCategoryName($name);

    public function getProductByBrandName($name);

    public function getProductByName($request);

    public function checkProductByName($request);

    public function countBrand();

    public function countCategory();

    public function searchProduct($request);
}