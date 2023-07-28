<?php

namespace App\Services\Product;

use App\Reponsitories\Product\ProductReponsitoryInterface;
use App\Services\BaseService;

class ProductService extends BaseService implements ProductServiceInterface
{
    public $reponsitory;

    public function __construct(ProductReponsitoryInterface  $productReponsitory)
    {
        $this->reponsitory = $productReponsitory;
    }

    public function find(int $id)
    {
        $product = $this->reponsitory->find($id);

        $avgRating = 0;
        $sumRating = array_sum(array_column($product->productComments->toArray(), 'rating'));
        $countRating = count($product->productComments);
        if($countRating != 0) {
            $avgRating = $sumRating/$countRating;
        }

        $product->avgRating = $avgRating;
        return $product;

    }

    public function getRalatedProduct($product, $limit = 4){

        return $this->reponsitory->getRalatedProduct($product, $limit);
    }

    public function getFeaturedProducts() {
        return [
            'men' => $this->reponsitory->getFeatureProductsByCategory(1),
            'women' => $this->reponsitory->getFeatureProductsByCategory(2),
        ];
    }

    public function getProductOnIndex($request) {
        return $this->reponsitory ->getProductOnIndex($request);
    }

    public function getProductsByCategory($categoryName, $request) {
        return $this->reponsitory->getProductsByCategory($categoryName, $request);
    }

    }
