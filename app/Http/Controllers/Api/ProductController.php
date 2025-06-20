<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Http\Controllers\Controller;
use App\Services\ProductPriceService;
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
     * Get prices for a specific product.
     *
     * @param Product $product
     *
     * @return [type]
     */
    public function getPrices(Product $product)
    {
        $prices = $this->productService->getPrices($product);
        return response()->json($prices);
    }

    public function addPrice(Request $request, Product $product)
    {
        $request->validate([
            'currency_id' => 'required|exists:currencies,id',
            'price' => 'required|decimal:0.01,999999.99',
        ]);

        $data = $request->only(['currency_id', 'price']);
        $data['product_id'] = $product->id;

        $productPrice = (new ProductPriceService())->create($data);
        return response()->json($productPrice, 201);
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
