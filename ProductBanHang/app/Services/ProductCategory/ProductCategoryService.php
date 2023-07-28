<?php

namespace App\Services\ProductCategory;

use App\Reponsitories\ProductCategory\ProductCategoryReponsitoryInterface;
use App\Services\BaseService;

class ProductCategoryService extends BaseService implements ProductCategoryServiceInterface
{
    public $reponsitory;

    public function __construct(ProductCategoryReponsitoryInterface $productCategoryReponsitory)
    {
        $this->reponsitory = $productCategoryReponsitory;
    }

}
