<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use App\Models\Currency;
use App\Models\ProductPrice;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'admin@admin.com',
            'password' => 'admin1234'
        ]);
        $currencies = Currency::factory()->count(5)->create();

        $currencies->each(function ($currency) {
            Product::factory()
                ->count(10)
                ->create(['currency_id' => $currency->id])
                ->each(function ($product) use ($currency) {
                    // Crear precios en otras monedas para el producto
                    $otherCurrencies =Currency::where('id', '!=', $currency->id)->get();

                    foreach ($otherCurrencies as $otherCurrency) {
                        ProductPrice::factory()->create([
                            'product_id' => $product->id,
                            'currency_id' => $otherCurrency->id,
                        ]);
                    }
                });
        });
    }
}
