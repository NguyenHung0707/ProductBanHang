<?php

namespace App\Reponsitories\Product;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Reponsitories\BaseReponsitory;
use http\Env\Request;


class ProductReponsitory extends BaseReponsitory implements ProductReponsitoryInterface
{

    public function getModel()
    {
        return Product::class;
    }

    public function  getRalatedProduct ($product, $limit = 4) {
        return $this-> model->where('product_category_id', $product->product_category_id)
            ->where('tag', $product->tag)
            ->limit($limit)
            ->get();
    }

    public function getFeatureProductsByCategory(int $categoryId) {
        return $this->model->where('featured', true)
            ->where('product_category_id', $categoryId)
            ->get();
    }


    public function getProductOnIndex($request){


        $search = $request->search ?? '';

        $products = $this->model->where('name', 'like', '%' . $search . '%');

        $products = $this->filter($products, $request);
        $products = $this->sortAndPagination($products, $request);

        return $products;

    }

    public function getProductsByCategory($categoryName, $request) {

        $products = ProductCategory::where('name', $categoryName)->first()->products->toQuery();

        $products = $this->filter($products, $request);
        $products = $this->sortAndPagination($products, $request);

        return $products;
    }

    private function sortAndPagination($products, $request) {
        $perPage = $request->show ?? 3;
        $sortBy = $request->sort_by ?? 'latest';

        switch ($sortBy) {
            case 'latest':
                $products = $products->orderBy('id');
                break;
            case 'oldest':
                $products = $products->orderByDesc('id');
                break;
            case 'name-ascending':
                $products = $products->orderBy('name');
                break;
            case 'name-descending':
                $products = $products->orderByDesc('name');
                break;
            case 'price-ascending':
                $products = $products->orderBy('price');
                break;
            case 'price-descending':
                $products = $products->orderByDesc('price');
                break;
            default:
                $products = $products->orderBy('id');

        }
        $products = $products->paginate($perPage);
        $products->appends(['sort_by' => $sortBy, 'show' => $perPage]);

        return $products;

    }

    private function  filter($products, $request) {
        $brands = $request->brand ?? [];
        $brand_ids = array_keys($brands);
        $products = $brand_ids != null ? $products->whereIn('brand_id', $brand_ids) : $products;

//        Price
        $priceMin = $request->price_min;
        $priceMax = $request->price_max;

        $priceMin = str_replace('$', '', $priceMin);
        $priceMax = str_replace('$', '', $priceMax);
        $products = ($priceMin != null && $priceMax != null)
            ? $products->whereBetween('price', [$priceMin, $priceMax]) : $products;

//        Color
        $color  = $request->color;
        $products = $color != null ? $products->whereHas('productDetails', function ($query) use ($color) {
            return $query->where('color', $color)->where('qty', '>', 0);
        }) : $products;


//        Size
        $size  = $request->size;
        $products = $size != null ? $products->whereHas('productDetails', function ($query) use ($size) {
            return $query->where('size', $size)->where('qty', '>', 0);
        }) : $products;
        return $products;

    }

}
