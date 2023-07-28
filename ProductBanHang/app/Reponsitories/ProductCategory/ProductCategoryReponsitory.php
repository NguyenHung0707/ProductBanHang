<?php

namespace App\Reponsitories\ProductCategory;

use App\Models\ProductCategory;
use App\Reponsitories\BaseReponsitory;

class ProductCategoryReponsitory extends BaseReponsitory implements ProductCategoryReponsitoryInterface
{

    public function getModel()
    {
        return ProductCategory::class;
    }
}
