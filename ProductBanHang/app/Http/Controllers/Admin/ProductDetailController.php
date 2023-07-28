<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductDetail;
use App\Services\Product\ProductServiceInterface;
use Illuminate\Http\Request;

class ProductDetailController extends Controller
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
        $productDetails = $product->productDetails;
        return view('admin.product.detail.index', compact('product', 'productDetails'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($product_id)
    {
        $product = $this->productService->find($product_id);

        return view('admin.product.detail.create', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $product_id)
    {
        //
        $data = $request->all();
        ProductDetail::create($data);

        $this->updateQty($product_id);

        return redirect('admin/product/' .  $product_id . '/detail');
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
    public function edit($product_id, $product_detail_id)
    {
        $product = $this->productService->find($product_id);

        $productDetail = ProductDetail::find($product_detail_id);

        return view('admin.product.detail.edit', compact('product', 'productDetail'));


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $product_id, $product_detail_id)
    {
        $data = $request->all();

        ProductDetail::find($product_detail_id)->update($data);
        $this->updateQty($product_id);

        return redirect('admin/product/' . $product_id . '/detail' );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($product_id, $product_detail_id)
    {
        ProductDetail::find($product_detail_id)->delete();

        return redirect('admin/product/' . $product_id . '/detail');

    }

    public function updateQty($product_id){

        $product = $this->productService->find($product_id);
        $productDetails = $product->productDetails;

        $totalQty = array_sum(array_column($productDetails->toArray(),'qty'));

        $this->productService->update(['qty' => $totalQty], $product_id);
    }
}
