<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreRequest;
use App\Http\Requests\Product\UpdateRequest;

class ProductController extends Controller
{
    protected $productService;
    public function __construct()
    {
        $this->productService = new ProductService();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currencies = $this->productService->getAll();
        return response()->json($currencies);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $product = $this->productService->create($request->validated());
        return response()->json($product, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return response()->json($product);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Product $product)
    {
        $product = $this->productService->update($product, $request->validated());
        return response()->json($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            $this->productService->delete(product: $product);
            return response()->json('Successfully removed', 204);
        } catch (\Exception $e) {
            return response()->json('Failed to remove', 500);
        }
    }
}
