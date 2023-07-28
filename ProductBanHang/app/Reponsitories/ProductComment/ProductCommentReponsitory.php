<?php

namespace App\Reponsitories\ProductComment;

use App\Models\ProductComment;
use App\Reponsitories\BaseReponsitory;
use App\Reponsitories\ReponsitoryInterface;

class ProductCommentReponsitory extends BaseReponsitory implements ProductCommentReponsitoryInterface
{

    public function getModel()
    {
        return ProductComment::class;
    }
}
