<?php

namespace App\Reponsitories\Order;

use App\Models\Order;
use App\Reponsitories\BaseReponsitory;

class OrderReponsitory extends BaseReponsitory implements OrderReponsitoryInterface
{

    public function getModel()
    {
        return Order::class;
    }

    public function getOrderByUserId($userId)
    {
        return $this->model->where('user_id', $userId)->get();
    }
}
