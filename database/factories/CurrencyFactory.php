<?php

namespace Database\Factories;

use App\Models\Currency;
use Illuminate\Database\Eloquent\Factories\Factory;

class CurrencyFactory extends Factory
{
    protected $model = Currency::class;

    public function definition(): array
    {
        $currencies = [
            ['name' => 'US Dollar', 'symbol' => 'USD'],
            ['name' => 'Euro', 'symbol' => 'EUR'],
            ['name' => 'Japanese Yen', 'symbol' => 'JPY'],
            ['name' => 'British Pound', 'symbol' => 'GBP'],
            ['name' => 'Canadian Dollar', 'symbol' => 'CAD'],
        ];

        $currency = $this->faker->randomElement($currencies);

        return [
            'name' => $currency['name'],
            'symbol' => $currency['symbol'],
            'exchange_rate' => $this->faker->randomFloat(6, 0.5, 2.0),
        ];
    }
}
