<?php

namespace App\Http\Controllers\Supplies;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Supplies\Supplies;
use App\Models\Supplies\SuppliesStock;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Supplies\SuppliesStockController;

class SuppliesStockController extends Controller
{
    public function index() 
    {
        $supplies = Supplies::select(
            DB::raw('"SuppliesBrandName"'),
            DB::raw('"SuppliesName"'),
            DB::raw('"SuppliesCategory"'),
            DB::raw('"SuppliesClassification"'),
            DB::raw('"SuppliesColor"'),
            DB::raw('"SuppliesType"'),
            DB::raw('"SuppliesUnit"'),
            DB::raw('"SuppliesUnitPrice"'),
            DB::raw('"SuppliesDate"'),
            DB::raw('"SuppliesSKU"'),
            DB::raw('SUM(COALESCE("SuppliesQuantity", 0)) AS "SuppliesQuantity"'),
            DB::raw('SUM(COALESCE("SuppliesUnitPrice", 0) * COALESCE("SuppliesQuantity", 0)) AS "totalPrice"'),
            DB::raw('COUNT(*) AS "totalItems"')
        )
        ->groupBy(
            DB::raw('"SuppliesBrandName"'),
            DB::raw('"SuppliesName"'),
            DB::raw('"SuppliesCategory"'),
            DB::raw('"SuppliesClassification"'),
            DB::raw('"SuppliesColor"'),
            DB::raw('"SuppliesType"'),
            DB::raw('"SuppliesUnit"'),
            DB::raw('"SuppliesUnitPrice"'),
            DB::raw('"SuppliesDate"'),
            DB::raw('"SuppliesSKU"')
        )
        ->get();

        return view('adminPages.admin_supplies', compact('supplies'));
    }
}
