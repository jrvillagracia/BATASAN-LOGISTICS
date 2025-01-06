<?php

namespace App\Http\Controllers\Supplies;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
//use App\Models\Supplies\Supplies;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Supplies\SuppliesStock;
//use App\Http\Controllers\Supplies\SuppliesStockController;

class SuppliesStockController extends Controller
{
    public function index() 
    {
        $supplies = SuppliesStock::select(
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

    public function suppliesDetails(Request $request)
    {
        // Get the supplies brand name from the request
        $brandName = $request->input('SuppliesBrandName');

        if (!$brandName) {
            return response()->json(['message' => 'Brand name is required'], 400);
        }

        // Fetch supplies details that match the brand name
        $suppliesDetails= SuppliesStock::select(
                'suppliesStockId',
                'SuppliesBrandName',
                'SuppliesName',
                'SuppliesCategory',
                'SuppliesType',
                'SuppliesColor',
                'SuppliesUnit',
                'SuppliesSKU',
                'SuppliesColor',
                'SuppliesUnitPrice',
                'SuppliesClassification',
                'SuppliesDate'
            )
            ->where('SuppliesBrandName', 'like', $brandName) 
            ->get();

        if ($suppliesDetails->isEmpty()) {
            return response()->json(['message' => 'Supplies not found'], 404);
        }

        // Prepare response with the brand name prefix and supplies details
        return response()->json([
            'brandName' => $brandName,
            'suppliesDetails' => $suppliesDetails->map(function ($supplies) {
                return [
                    'suppliesStockId' => $supplies->suppliesStockId, // Include ID
                    'SuppliesBrandName' => $supplies->SuppliesBrandName,
                    'SuppliesName' => $supplies->SuppliesName,
                    'SuppliesCategory' => $supplies->SuppliesCategory,
                    'SuppliesType' => $supplies->SuppliesType,
                    'SuppliesColor' => $supplies->SuppliesColor,
                    'SuppliesSKU' => $supplies->SuppliesSKU,
                    'SuppliesUnit' => $supplies->SuppliesUnit,
                    'SuppliesUnitPrice' => $supplies->SuppliesUnitPrice,
                    'SuppliesClassification' => $supplies->SuppliesClassification,
                    'SuppliesDate' => $supplies->SuppliesDate,
                ];
            })
        ]);
    }

    public function updateSupplies(Request $request)
    {
        Log::info('Incoming request data for Supplies Edit:', $request->all());

        // Validate the incoming request data for the supplies table
        $validatedData = $request->validate([
            'SUPPLIESBrandNameEDT' => 'required|string|max:255',
            'SUPPLIESNameEDT' => 'required|string|max:255',
            'SuppliesStockCategoryEdit' => 'required|string',
            'otherSUPPLIESCategoryEDT' => 'nullable|required_if:SuppliesCategoryEdit,other|string|max:255',
            'SUPPLIESQuantityEDT' => 'required|integer',
            'SUPPLIESColorEDT' => 'required|string|max:255',
            'SUPPLIESTypeEDT' => 'required|string|max:255',
            'SUPPLIESUnitEDT' => 'required|string|max:255',
            'SUPPLIESUnitPriceEDT' => 'required|numeric',
            'SUPPLIESClassificationEDT' => 'required|string|max:255',
            'SUPPLIESSKUEDT' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
        ]);

        $category = $validatedData['SuppliesStockCategoryEdit'];
        if ($category === 'other' && !empty($validatedData['otherSUPPLIESCategoryEDT'])) {
            $category = $validatedData['otherSUPPLIESCategoryEDT'];
        }

        // Update the supplies based on the brand
        $updateCount = SuppliesStock::where('SuppliesBrandName', $validatedData['brand'])->update([
            'SuppliesBrandName' => $validatedData['SUPPLIESBrandNameEDT'],
            'SuppliesName' => $validatedData['SUPPLIESNameEDT'],
            'SuppliesCategory' => $category,
            'SuppliesQuantity' => (int)$validatedData['SUPPLIESQuantityEDT'],
            'SuppliesColor' => $validatedData['SUPPLIESColorEDT'],
            'SuppliesType' => $validatedData['SUPPLIESTypeEDT'],
            'SuppliesUnit' => $validatedData['SUPPLIESUnitEDT'],
            'SuppliesUnitPrice' => $validatedData['SUPPLIESUnitPriceEDT'],
            'SuppliesClassification' => $validatedData['SUPPLIESClassificationEDT'],
            'SuppliesSKU' => $validatedData['SUPPLIESSKUEDT'],
        ]);

        // Check if any rows were updated
        if ($updateCount > 0) {
            return response()->json(['message' => 'Supplies updated successfully in Main Table']);
        } else {
            return response()->json(['message' => 'No supplies found to update'], 404);
        }
    }


    public function destroy(Request $request)
    {
        $brandName = $request->input('brand');

        Log::info('Incoming brand name for deletion:', ['brand' => $brandName]);

        // Check if brandName is null or empty
        if (empty($brandName)) {
            return response()->json(['message' => 'Brand name is required.'], 400);
        }

        $suppliesItems = SuppliesStock::where('SuppliesBrandName', $brandName)->get();

        if ($suppliesItems->isEmpty()) {
            return response()->json(['message' => 'Supplies item not found.'], 404);
        }

        SuppliesStock::where('SuppliesBrandName', $brandName)->delete();

        return response()->json(['message' => 'All supplies items deleted successfully.'], 200);
    }
}
