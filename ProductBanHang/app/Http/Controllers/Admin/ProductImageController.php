<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductImage;
use App\Services\Product\ProductServiceInterface;
use App\Utilities\Common;
use Illuminate\Http\Request;

class ProductImageController extends Controller
{
    private $productService;

    public function __construct(ProductServiceInterface $productService)
    {


        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index($product_id)
    {

        $product = $this->productService->find($product_id);
        $productImages = $product->productImages;
        return view('admin.product.image.index', compact('product', 'productImages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $product_id)
    {
        $data = $request->all();

        // Xử lý file:
        if($request->hasFile('image')) {
            $data['path'] = Common::uploadFile($request->file('image'), path: 'front/img/products');
            unset($data['image']);

            ProductImage::create($data);
        }
        return redirect('admin/product/'.$product_id .'/image');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($product_id ,$product_image_id )
    {
        $file_name = ProductImage::find($product_image_id)->path;

        if($file_name != '') {
            unlink('front/img/products/'.$file_name);
        }


        //Xóa bản ghi trong Database:
        ProductImage::find($product_image_id)->delete();

        return redirect('admin/product/'.$product_id.'/image');
    }
}
