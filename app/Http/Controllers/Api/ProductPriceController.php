<?php

namespace App\Http\Controllers\Api;

use App\Models\ProductPrice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ProductPriceService;
use App\Http\Requests\ProductPrice\StoreRequest;
use App\Http\Requests\ProductPrice\UpdateRequest;

class ProductPriceController extends Controller
{
    protected $productPriceService;
    public function __construct()
    {
        $this->productPriceService = new ProductPriceService();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currencies = $this->productPriceService->getAll();
        return response()->json($currencies);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $productPrice = $this->productPriceService->create($request->validated());
        return response()->json($productPrice, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductPrice $productPrice)
    {
        return response()->json($productPrice);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, ProductPrice $productPrice)
    {
        $productPrice = $this->productPriceService->update($productPrice, $request->validated());
        return response()->json($productPrice);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductPrice $productPrice)
    {
        try {
            $this->productPriceService->delete(productPrice: $productPrice);
            return response()->json('Successfully removed', 204);
        } catch (\Exception $e) {
            return response()->json('Failed to remove', 500);
        }
    }
}
