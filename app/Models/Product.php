<?php

namespace App\Models;

use App\Models\Currency;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $guarded = ['id'];

    protected $casts = [
        'price' => 'float',
        'tax_cost' => 'float',
        'manufacturing_cost' => 'float',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get all of the currency for the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function currency(): HasMany
    {
        return $this->hasMany(Currency::class, 'id', 'currency_id');
    }
}
