<?php

namespace App\Http\Controllers\Api;

use App\Models\Currency;
use Illuminate\Http\Request;
use App\Services\CurrencyService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Currency\StoreRequest;
use App\Http\Requests\Currency\UpdateRequest;

class CurrencyController extends Controller
{
    protected $currencyService;
    public function __construct()
    {
        $this->currencyService = new CurrencyService();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currencies = $this->currencyService->getAll();
        return response()->json($currencies);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $currency = $this->currencyService->create($request->validated());
        return response()->json($currency, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Currency $currency)
    {
        return response()->json($currency);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Currency $currency)
    {
        $currency = $this->currencyService->update($currency, $request->validated());
        return response()->json($currency);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Currency $currency)
    {
        try {
            $this->currencyService->delete(currency: $currency);
            return response()->json('Successfully removed', 204);
        } catch (\Exception $e) {
            return response()->json('Failed to remove', 500);
        }
    }
}
