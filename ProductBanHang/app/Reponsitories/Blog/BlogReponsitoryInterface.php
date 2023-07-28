<?php

namespace App\Reponsitories\Blog;

use App\Reponsitories\ReponsitoryInterface;

interface BlogReponsitoryInterface extends ReponsitoryInterface
{

    public function getLatestBlogs($limit = 3);
}
