<?php

namespace App\Services\Product;

use App\Services\ServiceInterface;

interface ProductServiceInterface extends ServiceInterface
{
    public function getRalatedProduct($product, $limit = 4);
    public function getFeaturedProducts();
    public function getProductOnIndex($request);
    public function getProductsByCategory($categoryName, $request);



    }
