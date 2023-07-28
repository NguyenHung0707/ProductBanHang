<?php

namespace App\Reponsitories\Order;

use App\Reponsitories\ReponsitoryInterface;

interface OrderReponsitoryInterface extends ReponsitoryInterface
{
    public function getOrderByUserId($userId);
}
