<?php

namespace App\Services\OrderDetail;

use App\Reponsitories\Order\OrderReponsitoryInterface;
use App\Services\BaseService;

class OrderDetailService extends BaseService implements OrderDetailServiceInterface
{
    public $reponsitory;
    public function __construct(OrderReponsitoryInterface  $orderReponsitory)
    {
        $this->reponsitory = $orderReponsitory;
    }
}
