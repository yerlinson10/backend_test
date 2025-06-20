<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Collection;

class ProductService
{
    /**
     * Get all currencies.
     *
     * @return Collection
     */
    public function getAll(): Collection
    {
        return Product::all()->load(['currency', 'prices']);
    }

    /**
     * Create a new product.
     *
     * @param array $data
     * @return Product
     */
    public function create(array $data): Product
    {
        $product = Product::create($data)->load('currency');
        return $product;
    }

    /**
     * Update an existing product.
     *
     * @param Product $product
     * @param array $data
     * @return Product
     */
    public function update(Product $product, array $data): Product
    {
        $product->update($data);
        return $product->load(['currency', 'prices']);
    }


    /**
     * Delete a product.
     *
     * @param Product $product
     * @return void
     */
    public function delete(Product $product): void
    {
        $product->delete();
    }
}
