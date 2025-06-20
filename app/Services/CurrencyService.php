<?php

namespace App\Services;
use App\Models\Currency;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class CurrencyService
{
    /**
     * Get all currencies.
     *
     * @return Collection
     */
    public function getAll(): Collection
    {
        return Currency::all();
    }

    /**
     * Create a new currency.
     *
     * @param array $data
     * @return Currency
     */
    public function create(array $data): Currency
    {
        return Currency::create($data);
    }

    /**
     * Update an existing currency.
     *
     * @param Currency $currency
     * @param array $data
     * @return Currency
     */
    public function update(Currency $currency, array $data): Currency
    {
        $currency->update($data);
        return $currency;
    }


    /**
     * Delete a currency.
     *
     * @param Currency $currency
     * @return void
     */
    public function delete(Currency $currency): void
    {
        $currency->delete();
    }
}
