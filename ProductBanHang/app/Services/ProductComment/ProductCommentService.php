<?php

namespace App\Services\ProductComment;

use App\Reponsitories\ProductCategory\ProductCategoryReponsitoryInterface;
use App\Reponsitories\ProductComment\BlogReponsitoryInterface;
use App\Services\BaseService;

class ProductCommentService extends BaseService implements ProductCommentServiceInterface
{

    public $reponsitory;

    public function __construct(ProductCategoryReponsitoryInterface $productCommentReponsitory)
    {
        $this->reponsitory = $productCommentReponsitory;
    }
}
