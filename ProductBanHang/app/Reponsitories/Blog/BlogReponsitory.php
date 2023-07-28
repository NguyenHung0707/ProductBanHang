<?php

namespace App\Reponsitories\Blog;

use App\Models\Blog;
use App\Reponsitories\BaseReponsitory;

class BlogReponsitory extends BaseReponsitory implements BlogReponsitoryInterface
{

    public function getModel()
    {
        return Blog::class;
    }

    public function getLatestBlogs($limit = 3) {

        return $this->model->orderBy('id', 'desc')
            ->limit($limit)
            ->get();
    }
}
