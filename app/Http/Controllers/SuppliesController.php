<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Supplies;

class SuppliesController extends Controller
{
    public function index()
    {
        $supplies = Supplies::select(
                'SuppliesBrandName',
                'SuppliesName',
                'SuppliesCategory',
                'SuppliesQuantity',
                'SuppliesSKU',
                DB::raw('COUNT(*) as SuppliesQuantity'),
                DB::raw('SUM(COALESCE("SuppliesUnitPrice", 0) * COALESCE("SuppliesQuantity", 0)) AS totalPrice'),
                DB::raw('COUNT(*) as totalItems')
            )
            ->groupBy('SuppliesBrandName', 'SuppliesName', 'SuppliesCategory', 'SuppliesQuantity' , 'SuppliesSKU')
            ->get();

        Log::info('Supplies Data:', $supplies->toArray());

        return view('adminPages.admin_supplies', compact('supplies'));
    }

    public function finalViewing(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'id' => 'required|integer|exists:supplies,id', // Change to supplies
        ]);

        $id = $validated['id'];

        // Fetch all details of the supplies
        $suppliesDetails = Supplies::select(
            'id',
            'SuppliesControlNo', 
            'SuppliesSerialNo',   
            'SuppliesBrandName',
            'SuppliesName',       
            'SuppliesCategory',
            'SuppliesType',       
            'SuppliesColor',     
            'SuppliesUnit',
            'SuppliesQuantity',
            'SuppliesUnitPrice',
            'SuppliesClassification', 
            'SuppliesDate'       
        )
        ->where('id', $id)
        ->first();

        if (!$suppliesDetails) {
            return response()->json(['message' => 'Supplies not found'], 404);
        }

        // Return the supplies details
        return response()->json($suppliesDetails);
    }



    public function create()
    {
        return view('adminPages.admin_supplies');
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
            'SuppliesQuantity' => 'required|integer',
            'SuppliesDate' => 'required|date',
            'SuppliesUnitPrice' => 'required|numeric',
            'SuppliesClassification' => 'required|string|max:255',
            'SuppliesSKU' => 'required|string|max:255',
            'SuppliesSerialNo' => 'required|string|max:255',
        ]);

        // Create a new supplies entry in the database
        for ($i = 0; $i < $validatedData['SuppliesQuantity']; $i++) {
            // Extract the first three letters of the brand name in uppercase
            $brandAbbreviation = strtoupper(substr($request->SuppliesBrandName, 0, 3));

            // Find the latest entry for this brand
            $latestSupplies = Supplies::where('SuppliesBrandName', $request->SuppliesBrandName)
                                    ->orderBy('id', 'desc')
                                    ->first();

            if ($latestSupplies) {
                // Extract the number part from the latest control number and increment it
                $latestControlNo = $latestSupplies->SuppliesControlNo;
                $latestNumber = (int) substr($latestControlNo, -4); // Extract last 4 digits
                $newNumber = $latestNumber + 1;
            } else {
                // If no entries exist for this brand, start from 0001
                $newNumber = 1;
            }

            // Prepare the control number for the new item
            $controlNumber = $brandAbbreviation . '-' . str_pad($newNumber, 4, '0', STR_PAD_LEFT);

            $supplies = Supplies::create([
                'SuppliesBrandName' => $validatedData['SuppliesBrandName'],
                'SuppliesName' => $validatedData['SuppliesName'],
                'SuppliesCategory' => $validatedData['SuppliesCategory'],
                'SuppliesType' => $validatedData['SuppliesType'],
                'SuppliesColor' => $validatedData['SuppliesColor'],
                'SuppliesUnit' => $validatedData['SuppliesUnit'],
                'SuppliesQuantity' => 1, // Save one quantity for each entry
                'SuppliesDate' => $validatedData['SuppliesDate'],
                'SuppliesUnitPrice' => $validatedData['SuppliesUnitPrice'],
                'SuppliesClassification' => $validatedData['SuppliesClassification'],
                'SuppliesSKU' => $validatedData['SuppliesSKU'],
                'SuppliesSerialNo' => $validatedData['SuppliesSerialNo'],
                'SuppliesControlNo' => $controlNumber, // Save the generated control number
            ]);
        }

        // Return a response with the control number and success message
        return response()->json([
            'message' => 'Supplies saved successfully!',
            'controlNo' => $controlNumber, // Return the control number
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
            'SuppliesBrandName' => 'required|string|max:255',
            'SuppliesName' => 'required|string|max:255',
            'SuppliesCategory' => 'required|string',
            'SuppliesSKU' => 'required|string|max:255',
            'brand' => 'required|string|max:255', // Ensure brand is validated
        ]);

        // Update the supplies based on the brand
        $updateCount = Supplies::where('SuppliesBrandName', $validatedData['brand'])->update([
            'SuppliesBrandName' => $validatedData['SuppliesBrandName'],
            'SuppliesName' => $validatedData['SuppliesName'],
            'SuppliesCategory' => $validatedData['SuppliesCategory'],
            'SuppliesSKU' => $validatedData['SuppliesSKU'],
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
        $supplies = Supplies::find($id); // Change Equipment to Supplies

        if ($supplies) {
            $supplies->delete();
            return response()->json(['message' => 'Supplies item deleted successfully.'], 200); // Update message
        } else {
            return response()->json(['message' => 'Supplies item not found.'], 404); // Update message
        }
    }
}

