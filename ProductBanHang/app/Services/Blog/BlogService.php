<?php

namespace App\Services\Blog;

use App\Reponsitories\Blog\BlogReponsitoryInterface;
use App\Reponsitories\Product\ProductReponsitoryInterface;
use App\Services\BaseService;

class BlogService extends BaseService implements BlogServiceInterface
{
    public $reponsitory;
    public function __construct(BlogReponsitoryInterface  $blogReponsitory)
    {
        $this->reponsitory = $blogReponsitory;
    }
    public function getLatestBlogs($limit = 3) {
        return $this->reponsitory->getLatestBlogs($limit);
    }
}
