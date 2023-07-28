<?php

namespace App\Reponsitories\OrderDetail;

use App\Models\OrderDetail;
use App\Reponsitories\BaseReponsitory;

class OrderDetailReponsitory extends BaseReponsitory implements OrderDetailReponsitoryInterface
{

    public function getModel()
    {
        return OrderDetail::class;
    }
}
