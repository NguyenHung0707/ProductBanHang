<?php

namespace App\Services\Order;

use App\Reponsitories\Order\OrderReponsitoryInterface;
use App\Reponsitories\Product\ProductReponsitoryInterface;
use App\Services\BaseService;

class OrderService extends BaseService implements OrderServiceInterface
{
    public $reponsitory;
    public function __construct(OrderReponsitoryInterface  $orderReponsitory)
    {
        $this->reponsitory = $orderReponsitory;
    }


    public function getOrderByUserId($userId)
    {
        return $this->reponsitory->getOrderByUserId($userId);
    }
}
