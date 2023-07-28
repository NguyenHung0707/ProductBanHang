<?php

namespace App\Reponsitories\Brand;

use App\Models\Brand;
use App\Reponsitories\BaseReponsitory;

class BrandReponsitory extends BaseReponsitory implements BrandReponsitoryInterface

{
    public function getModel()
    {
        return Brand::class;
    }
}
