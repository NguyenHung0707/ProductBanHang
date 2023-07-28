<?php

namespace App\Reponsitories\User;

use App\Models\User;
use App\Reponsitories\BaseReponsitory;

class UserReponsitory extends BaseReponsitory implements UserReponsitoryInterface
{

    public function getModel()
    {
        return User::class;
    }


}
