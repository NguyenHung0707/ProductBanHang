<?php

namespace App\Services\User;

use App\Reponsitories\BaseReponsitory;
use App\Reponsitories\User\UserReponsitoryInterface;
use App\Services\BaseService;

class UserService extends BaseService implements UserServiceInterface
{
    public $reponsitory;

    public function __construct(UserReponsitoryInterface $userReponsitory)
    {
        $this->reponsitory = $userReponsitory;
    }
}
