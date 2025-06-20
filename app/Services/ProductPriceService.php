<?php

namespace App\Services;

use App\Models\ProductPrice;
use Illuminate\Support\Collection;

class ProductPriceService
{
    /**
     * Get all currencies.
     *
     * @return Collection
     */
    public function getAll(): Collection
    {
        return ProductPrice::all()->load(['currency', 'product']);
    }

    /**
     * Create a new productPrice.
     *
     * @param array $data
     * @return ProductPrice
     */
    public function create(array $data): ProductPrice
    {
        $productPrice = ProductPrice::create($data)->load(['currency', 'product']);
        return $productPrice;
    }

    /**
     * Update an existing productPrice.
     *
     * @param ProductPrice $productPrice
     * @param array $data
     * @return ProductPrice
     */
    public function update(ProductPrice $productPrice, array $data): ProductPrice
    {
        $productPrice->update($data);
        return $productPrice->load(['currency', 'product']);
    }


    /**
     * Delete a productPrice.
     *
     * @param ProductPrice $productPrice
     * @return void
     */
    public function delete(ProductPrice $productPrice): void
    {
        $productPrice->delete();
    }
}
