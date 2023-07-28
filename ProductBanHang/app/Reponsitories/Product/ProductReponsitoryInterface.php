<?php

namespace App\Reponsitories\Product;

use App\Reponsitories\ReponsitoryInterface;

interface ProductReponsitoryInterface extends ReponsitoryInterface
{
    public function getRalatedProduct($product, $limit = 4);
    public function getFeatureProductsByCategory(int $categoryId);
    public function getProductOnIndex($request);
    public function getProductsByCategory($categoryName, $request);










    }
