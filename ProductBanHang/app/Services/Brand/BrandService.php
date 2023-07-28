<?php

namespace App\Services\Brand;

use App\Reponsitories\Brand\BrandReponsitoryInterface;
use App\Services\BaseService;

class BrandService extends BaseService implements BrandServiceInterface

{
    public $reponsitory;

    public function __construct(BrandReponsitoryInterface $brandReponsitory)
    {
        $this->reponsitory = $brandReponsitory;
    }

}
