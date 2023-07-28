<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Product;
use Illuminate\Http\Request;

class Homecontroller extends Controller
{
    //


    public function index(){
        $menproducts = Product::where('featured', true)->where('product_category_id', 1)->get();
        $womenproducts = Product::where('featured', true)->where('product_category_id', 2)->get();

        $blogs = Blog::orderBy('id', 'desc') -> limit(3)->get();

        return view('front.index', compact('menproducts','womenproducts', 'blogs'));

    }
 }
