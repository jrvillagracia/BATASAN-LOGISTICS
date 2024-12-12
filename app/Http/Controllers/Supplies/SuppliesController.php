<?php

namespace App\Http\Controllers\Supplies;

use App\Models\Supplies\Supplies;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Supplies\SuppliesStock;
use App\Http\Controllers\Controller;

class SuppliesController extends Controller
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

        return view('adminPages.admin_StockInSupplies', compact('supplies'));
    }

    // public function finalViewing(Request $request)
    // {
    //     // Validate the incoming request
    //     $validated = $request->validate([
    //         'id' => 'required|integer|exists:supplies,id', // Change to supplies
    //     ]);

    //     $id = $validated['id'];

    //     // Fetch all details of the supplies
    //     $suppliesDetails = Supplies::select(
    //         'id',
    //         'SuppliesControlNo', 
    //         'SuppliesSerialNo',   
    //         'SuppliesBrandName',
    //         'SuppliesName',       
    //         'SuppliesCategory',
    //         'SuppliesType',       
    //         'SuppliesColor',     
    //         'SuppliesUnit',
    //         'SuppliesQuantity',
    //         'SuppliesUnitPrice',
    //         'SuppliesClassification', 
    //         'SuppliesDate'       
    //     )
    //     ->where('id', $id)
    //     ->first();

    //     if (!$suppliesDetails) {
    //         return response()->json(['message' => 'Supplies not found'], 404);
    //     }

    //     // Return the supplies details
    //     return response()->json($suppliesDetails);
    // }



    public function create()
    {
        return view('adminPages.admin_StockInSupplies');
    }

    public function store(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'SuppliesBrandName' => 'required|string|max:255',
            'SuppliesName' => 'required|string|max:255',
            'SuppliesCategory' => 'required|string|max:255',
            'SuppliesType' => 'required|string|max:255',
            'SuppliesColor' => 'required|string|max:255',
            'SuppliesUnit' => 'required|string|max:255',
            'SuppliesQuantity' => 'required|integer|min:1', // Ensure quantity is at least 1
            'SuppliesDate' => 'required|date',
            'SuppliesUnitPrice' => 'required|numeric|min:0', // Ensure unit price is non-negative
            'SuppliesClassification' => 'required|string|max:255',
            'SuppliesSKU' => 'required|string|max:255|unique:supplies,SuppliesSKU', // Ensure SKU is unique
        ]);

        $validatedData['SuppliesDate'] = Carbon::parse($validatedData['SuppliesDate'])->format('Y-m-d');

        // Save the supplies
        $supplies = Supplies::create([
            'SuppliesBrandName' => $validatedData['SuppliesBrandName'],
            'SuppliesName' => $validatedData['SuppliesName'],
            'SuppliesCategory' => $validatedData['SuppliesCategory'],
            'SuppliesType' => $validatedData['SuppliesType'],
            'SuppliesColor' => $validatedData['SuppliesColor'],
            'SuppliesUnit' => $validatedData['SuppliesUnit'],
            'SuppliesQuantity' => $validatedData['SuppliesQuantity'], // Save the provided quantity
            'SuppliesDate' => $validatedData['SuppliesDate'],
            'SuppliesUnitPrice' => $validatedData['SuppliesUnitPrice'],
            'SuppliesClassification' => $validatedData['SuppliesClassification'],
            'SuppliesSKU' => $validatedData['SuppliesSKU'],
        ]);

        // Return a JSON response
        return response()->json([
            'message' => 'Supplies saved successfully!',
            'supplies' => $supplies, // Optional: return the supplies details
        ]);
    }


    public function suppliesDetails(Request $request)
    {
        // Get the supplies brand name from the request
        $brandName = $request->input('SuppliesBrandName');

        if (!$brandName) {
            return response()->json(['message' => 'Brand name is required'], 400);
        }

        // Fetch supplies details that match the brand name
        $suppliesDetails= Supplies::select(
                'id',
                'SuppliesControlNo',
                'SuppliesSerialNo',
                'SuppliesBrandName',
                'SuppliesName',
                'SuppliesUnit',
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
                    'id' => $supplies->id, // Include ID
                    'SuppliesControlNo' => $supplies->SuppliesControlNo,
                    'SuppliesSerialNo' => $supplies->SuppliesSerialNo,
                    'SuppliesBrandName' => $supplies->SuppliesBrandName,
                    'SuppliesName' => $supplies->SuppliesName,
                    'SuppliesUnit' => $supplies->SuppliesUnit,
                    'SuppliesUnitPrice' => $supplies->SuppliesUnitPrice,
                    'SuppliesClassification' => $supplies->SuppliesClassification,
                    'SuppliesDate' => $supplies->SuppliesDate,
                ];
            })
        ]);
    }

    public function updateMain(Request $request)
    {
        Log::info('Incoming request data for Supplies Edit:', $request->all());

        // Validate the incoming request data for the supplies table
        $validatedData = $request->validate([
            'SuppliesBrandNameEdit' => 'required|string|max:255',
            'SuppliesNameEdit' => 'required|string|max:255',
            'SuppliesCategoryEdit' => 'required|string',
            'otherSuppCategoryEdit' => 'nullable|string|max:255',
            'SuppliesQuantityEdit' => 'required|integer',
            'SuppliesColorEdit' => 'required|string|max:255',
            'SuppliesTypeEdit' => 'required|string|max:255',
            'SuppliesUnitEdit' => 'required|string|max:255',
            'SuppliesUnitPriceEdit' => 'required|numeric',
            'SuppliesClassificationEdit' => 'required|string|max:255',
            'SuppliesSKUEdit' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
        ]);

        // Update the supplies based on the brand
        $updateCount = Supplies::where('SuppliesBrandName', $validatedData['brand'])->update([
            'SuppliesBrandName' => $validatedData['SuppliesBrandNameEdit'],
            'SuppliesName' => $validatedData['SuppliesNameEdit'],
            'SuppliesCategory' => $validatedData['SuppliesCategoryEdit'],
            'SuppliesQuantity' => (int)$validatedData['SuppliesQuantityEdit'],
            'SuppliesColor' => $validatedData['SuppliesColorEdit'],
            'SuppliesType' => $validatedData['SuppliesTypeEdit'],
            'SuppliesUnit' => $validatedData['SuppliesUnitEdit'],
            'SuppliesUnitPrice' => $validatedData['SuppliesUnitPriceEdit'],
            'SuppliesClassification' => $validatedData['SuppliesClassificationEdit'],
            'SuppliesSKU' => $validatedData['SuppliesSKUEdit'],
        ]);

        // Check if any rows were updated
        if ($updateCount > 0) {
            return response()->json(['message' => 'Supplies updated successfully in Main Table']);
        } else {
            return response()->json(['message' => 'No supplies found to update'], 404);
        }
    }

    public function updateView(Request $request)
    {
        // Validate incoming request data for Supplies
        $request->validate([
            'id' => 'required|integer|exists:supplies,id', // Ensure to check in the supplies table
            'FullSuppliesSerialNoEdit' => 'required|string|max:255',
            'FullSuppliesControlNoEdit' => 'required|string|max:255',
            'FullSuppliesTypeEdit' => 'required|string|max:255',
            'FullSuppliesColorEdit' => 'required|string|max:255',
            'FullSuppliesUnitEdit' => 'required|string|max:255',
            'FullSuppliesUnitPriceEdit' => 'required|numeric',
            'FullSuppliesClassificationEdit' => 'required|string|max:255',
            'FullSuppliesDateEdit' => 'required|date',
        ]);

        // Find the Supplies item by ID
        $supplies = Supplies::findOrFail($request->input('id'));

        // Update the supplies fields with the request data
        $supplies->SuppliesSerialNo = $request->input('FullSuppliesSerialNoEdit');
        $supplies->SuppliesControlNo = $request->input('FullSuppliesControlNoEdit');
        $supplies->SuppliesType = $request->input('FullSuppliesTypeEdit');
        $supplies->SuppliesColor = $request->input('FullSuppliesColorEdit');
        $supplies->SuppliesUnit = $request->input('FullSuppliesUnitEdit');
        $supplies->SuppliesUnitPrice = $request->input('FullSuppliesUnitPriceEdit');
        $supplies->SuppliesClassification = $request->input('FullSuppliesClassificationEdit');
        $supplies->SuppliesDate = $request->input('FullSuppliesDateEdit');

        // Save the updated supplies item
        $supplies->save();

        // Return a success response with the updated supplies item
        return response()->json(['message' => 'Supplies updated successfully.', 'supplies' => $supplies]);
    }



    public function destroy(Request $request)
    {
        $brandName = $request->input('brand');

        Log::info('Incoming brand name for deletion:', ['brand' => $brandName]);

        // Check if brandName is null or empty
        if (empty($brandName)) {
            return response()->json(['message' => 'Brand name is required.'], 400);
        }

        $suppliesItems = Supplies::where('SuppliesBrandName', $brandName)->get();

        if ($suppliesItems->isEmpty()) {
            return response()->json(['message' => 'Supplies item not found.'], 404);
        }

        Supplies::where('SuppliesBrandName', $brandName)->delete();

        return response()->json(['message' => 'All supplies items deleted successfully.'], 200);
    }

    public function destroyEdit2(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'id' => 'required|integer|exists:supplies,id', 
        ]);

        $id = $request->input('id');
        $supplies = Supplies::find($id); // Change Supplies to Supplies

        if ($supplies) {
            $supplies->delete();
            return response()->json(['message' => 'Supplies item deleted successfully.'], 200); // Update message
        } else {
            return response()->json(['message' => 'Supplies item not found.'], 404); // Update message
        }
    }

    public function approve(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'id' => 'required|string', 
        ]);

        // Find Supplies with the specified SuppliesBrandName
        $Supplies = Supplies::where('SuppliesBrandName', $validated['id'])->get();

        if ($Supplies->isEmpty()) {
            return response()->json(['message' => 'No Supplies found for the given brand name'], 404);
        }

        $firstBrandName = $Supplies->first()->SuppliesBrandName;

        try {
            // Insert all Supplies details into the 'Supplies_stock'
            foreach ($Supplies as $item) {
                SuppliesStock::create([
                    'SuppliesBrandName' => $item->SuppliesBrandName,
                    'SuppliesName' => $item->SuppliesName,
                    'SuppliesCategory' => $item->SuppliesCategory,
                    'SuppliesType' => $item->SuppliesType,
                    'SuppliesColor' => $item->SuppliesColor,
                    'SuppliesUnit' => $item->SuppliesUnit,
                    'SuppliesQuantity' => $item->SuppliesQuantity,
                    'SuppliesDate' => $item->SuppliesDate,
                    'SuppliesUnitPrice' => $item->SuppliesUnitPrice,
                    'SuppliesClassification' => $item->SuppliesClassification,
                    'SuppliesSKU' => $item->SuppliesSKU,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            // Delete all Supplies records with the specified SuppliesBrandName
            Supplies::where('SuppliesBrandName', $firstBrandName)->delete();

            return response()->json(['message' => 'Supplies approved successfully!']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error approving Supplies: ' . $e->getMessage()], 500);
        }
    }

}

