<?php

namespace App\Http\Controllers\Equipments;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Equipments\Equipment;
use App\Models\Equipments\EquipmentStock;

class EquipmentController extends Controller
{
    public function index()
    {
        $equipment = Equipment::select(
            DB::raw('"EquipmentBrandName"'),
            DB::raw('"EquipmentName"'),
            DB::raw('"EquipmentCategory"'),
            DB::raw('"EquipmentClassification"'),
            DB::raw('"EquipmentColor"'),
            DB::raw('"EquipmentType"'),
            DB::raw('"EquipmentUnit"'),
            DB::raw('"EquipmentUnitPrice"'),
            DB::raw('"EquipmentDate"'),
            DB::raw('"EquipmentSKU"'),
            DB::raw('SUM(COALESCE("EquipmentQuantity", 0)) AS "EquipmentQuantity"'),
            DB::raw('SUM(COALESCE("EquipmentUnitPrice", 0) * COALESCE("EquipmentQuantity", 0)) AS "totalPrice"'),
            DB::raw('COUNT(*) AS "totalItems"')
        )
        ->groupBy(
            DB::raw('"EquipmentBrandName"'),
            DB::raw('"EquipmentName"'),
            DB::raw('"EquipmentCategory"'),
            DB::raw('"EquipmentClassification"'),
            DB::raw('"EquipmentColor"'),
            DB::raw('"EquipmentType"'),
            DB::raw('"EquipmentUnit"'),
            DB::raw('"EquipmentUnitPrice"'),
            DB::raw('"EquipmentDate"'),
            DB::raw('"EquipmentSKU"')
        )
        ->get();
            
        return view('adminPages.admin_StockInEquipment', compact('equipment'));
    }

    public function finalViewing(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'id' => 'required|integer|exists:equipment,id',
        ]);

        // Get the equipment ID from the validated data
        $id = $validated['id'];

        // Fetch all details of the equipment
        $equipmentDetails = Equipment::select(
            'id',
            'EquipmentControlNo',
            'EquipmentSerialNo',
            'EquipmentBrandName',
            'EquipmentName',
            'EquipmentCategory',
            'EquipmentType',
            'EquipmentColor',
            'EquipmentUnit',
            'EquipmentQuantity',
            'EquipmentUnitPrice',
            'EquipmentClassification',
            'EquipmentDate'
        )
        ->where('id', $id)
        ->first();

        // Check if equipment details were found
        if (!$equipmentDetails) {
            return response()->json(['message' => 'Equipment not found'], 404);
        }

        // Return the equipment details
        return response()->json($equipmentDetails);
    }


    public function create()
    {
        return view('adminPages.admin_StockInEquipment');
    }

    public function store(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'EquipmentBrandName' => 'required|string|max:255',
            'EquipmentName' => 'required|string|max:255',
            'EquipmentCategory' => 'required|string|max:255',
            'EquipmentType' => 'required|string|max:255',
            'EquipmentColor' => 'required|string|max:255',
            'EquipmentUnit' => 'required|string|max:255',
            'EquipmentQuantity' => 'required|integer',
            'EquipmentDate' => 'required|date',
            'EquipmentUnitPrice' => 'required|numeric|max:5000',
            'EquipmentClassification' => 'required|string',
            'EquipmentSKU' => 'required|string|max:255',
            'EquipmentSerialNo' => 'nullable|string|max:255',
        ]);
    
        // Create a new equipment entry in the database
        for ($i = 0; $i < $validatedData['EquipmentQuantity']; $i++) {
            // Create a new equipment entry in the database

            // Extract the first three letters of the brand name in uppercase
        $brandAbbreviation = strtoupper(substr($request->EquipmentBrandName, 0, 3));
    
        // Find the latest entry for this brand
        $latestEquipment = Equipment::where('EquipmentBrandName', $request->EquipmentBrandName)
                                    ->orderBy('id', 'desc')
                                    ->first();
    
        if ($latestEquipment) {
            // Extract the number part from the latest control number and increment it
            $latestControlNo = $latestEquipment->EquipmentControlNo;
            $latestNumber = (int) substr($latestControlNo, -4); // Extract last 4 digits
            $newNumber = $latestNumber + 1;
        } else {
            // If no entries exist for this brand, start from 0001
            $newNumber = 1;
        }
    
        // Prepare the control number for the new item
        $controlNumber = $brandAbbreviation . '-' . str_pad($newNumber, 4, '0', STR_PAD_LEFT);

            $equipment = Equipment::create([
                'EquipmentBrandName' => $validatedData['EquipmentBrandName'],
                'EquipmentName' => $validatedData['EquipmentName'],
                'EquipmentCategory' => $validatedData['EquipmentCategory'],
                'EquipmentType' => $validatedData['EquipmentType'],
                'EquipmentColor' => $validatedData['EquipmentColor'],
                'EquipmentUnit' => $validatedData['EquipmentUnit'],
                'EquipmentQuantity' => 1, // Save one quantity for each entry
                'EquipmentDate' => $validatedData['EquipmentDate'],
                'EquipmentUnitPrice' => $validatedData['EquipmentUnitPrice'],
                'EquipmentClassification' => $validatedData['EquipmentClassification'],
                'EquipmentSKU' => $validatedData['EquipmentSKU'],
                'EquipmentSerialNo' => $validatedData['EquipmentSerialNo'] ?? null,
                'EquipmentControlNo' => $controlNumber, 
            ]);
        }
        
        // Return a response with the control number and success message
        return response()->json([
            'message' => 'Equipment saved successfully!',
            'controlNo' => $controlNumber, // Return the control number
            'equipment' => $equipment, // Optional: return the equipment details
        ]);
    }


    public function equipmentDetails(Request $request)
    {
        // Get the equipment brand name from the request
        $brandName = $request->input('EquipmentBrandName');

        if (!$brandName) {
            return response()->json(['message' => 'Brand name is required'], 400);
        }

        // Fetch equipment details that match the brand name
        $equipmentDetails = Equipment::select(
                'id',
                'EquipmentControlNo',
                'EquipmentBrandName',
                'EquipmentName',
                'EquipmentCategory',
                'EquipmentSKU',
                'EquipmentColor',
                'EquipmentType',
                'EquipmentUnit',
                'EquipmentUnitPrice',
                'EquipmentClassification',
                'EquipmentDate'
            )
            ->where('EquipmentBrandName', 'like', $brandName) 
            ->get();

        if ($equipmentDetails->isEmpty()) {
            return response()->json(['message' => 'Equipment not found'], 404);
        }

        // Prepare response with the brand name prefix and equipment details
        return response()->json([
            'brandName' => $brandName,
            'equipmentDetails' => $equipmentDetails->map(function ($equipment) {
                return [
                    'id' => $equipment->id, // Include ID
                    'EquipmentControlNo' => $equipment->EquipmentControlNo,
                    'EquipmentBrandName' => $equipment->EquipmentBrandName,
                    'EquipmentName' => $equipment->EquipmentName,
                    'EquipmentCategory' => $equipment->EquipmentCategory,
                    'EquipmentSKU' => $equipment->EquipmentSKU,
                    'EquipmentColor' => $equipment->EquipmentColor,
                    'EquipmentType' => $equipment->EquipmentType,
                    'EquipmentUnit' => $equipment->EquipmentUnit,
                    'EquipmentUnitPrice' => $equipment->EquipmentUnitPrice,
                    'EquipmentClassification' => $equipment->EquipmentClassification,
                    'EquipmentDate' => $equipment->EquipmentDate,
                ];
            })
        ]);
    }


    public function updateMain(Request $request)
    {
        Log::info('Incoming request data for Main :', $request->all());
    
        // Validate the incoming request data for the main table
        $validatedData = $request->validate([
            'EquipmentBrandNameEdit' => 'required|string|max:255',
            'EquipmentNameEdit' => 'required|string|max:255',
            'EquipmentCategoryEdit' => 'required|string',
            'otherEquipCategoryEdit' => 'nullable|string|max:255',
            'EquipmentQuantityEdit' => 'required|integer',
            'EquipmentColorEdit' => 'required|string|max:255',
            'EquipmentTypeEdit' => 'required|string|max:255',
            'EquipmentUnitEdit' => 'required|string|max:255',
            'EquipmentUnitPriceEdit' => 'required|numeric',
            'EquipmentClassificationEdit' => 'required|string|max:255',
            'EquipmentSKUEdit' => 'required|string|max:255',
            'brand' => 'required|string|max:255', 
        ]);
        
    
        // Update the equipment based on the brand
        $updateCount = Equipment::where('EquipmentBrandName', $validatedData['brand'])->update([
            'EquipmentBrandName' => $validatedData['EquipmentBrandNameEdit'],
            'EquipmentName' => $validatedData['EquipmentNameEdit'],
            'EquipmentCategory' => $validatedData['EquipmentCategoryEdit'],
            'EquipmentQuantity' => $validatedData['EquipmentQuantityEdit'],
            'EquipmentColor' => $validatedData['EquipmentColorEdit'],
            'EquipmentType' => $validatedData['EquipmentTypeEdit'],
            'EquipmentUnit' => $validatedData['EquipmentUnitEdit'],
            'EquipmentUnitPrice' => $validatedData['EquipmentUnitPriceEdit'],
            'EquipmentClassification' => $validatedData['EquipmentClassificationEdit'],
            'EquipmentSKU' => $validatedData['EquipmentSKUEdit'],
        ]);
    
        // Check if any rows were updated
        if ($updateCount > 0) {
            return response()->json(['message' => 'Equipment updated successfully in Main Table']);
        } else {
            return response()->json(['message' => 'No equipment found to update'], 404);
        }
    }
    

    public function updateView(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:equipment,id',
            'FullEquipmentSerialNo' => 'required|string|max:255',
            'FullEquipmentType' => 'required|string|max:255',
            'FullEquipmentColor' => 'required|string|max:255',
            'FullEquipmentUnit' => 'required|string|max:255',
            'FullEquipmentUnitPrice' => 'required|numeric',
            'FullEquipmentClassification' => 'required|string|max:255',
            'FullEquipmentDate' => 'required|date',
        ]);

        $equipment = Equipment::findOrFail($request->input('id'));

        $equipment->EquipmentSerialNo = $request->input('FullEquipmentSerialNo');
        $equipment->EquipmentType = $request->input('FullEquipmentType');
        $equipment->EquipmentColor = $request->input('FullEquipmentColor');
        $equipment->EquipmentUnit = $request->input('FullEquipmentUnit');
        $equipment->EquipmentUnitPrice = $request->input('FullEquipmentUnitPrice');
        $equipment->EquipmentClassification = $request->input('FullEquipmentClassification');
        $equipment->EquipmentDate = $request->input('FullEquipmentDate');

        $equipment->save();

        return response()->json(['message' => 'Equipment updated successfully.', 'equipment' => $equipment]);
    }




    public function destroy(Request $request)
    {
        $brandName = $request->input('brand');

        Log::info('Incoming brand name for deletion:', ['brand' => $brandName]);

        $equipmentItems = Equipment::where('EquipmentBrandName', $brandName)->get();

        if ($equipmentItems->isEmpty()) {
            return response()->json(['message' => 'Equipment item not found.'], 404);
        }

        Equipment::where('EquipmentBrandName', $brandName)->delete();

        return response()->json(['message' => 'All equipment items deleted successfully.'], 200);
    }   


    public function destroy2(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'id' => 'required|integer|exists:equipment,id',
        ]);

        $id = $request->input('id');
        $equipment = Equipment::find($id);

        if ($equipment) {
            $equipment->delete();
            return response()->json(['message' => 'Equipment item deleted successfully.'], 200);
        } else {
            return response()->json(['message' => 'Equipment item not found.'], 404);
        }
    }

    public function approve(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'id' => 'required|string', // The EquipmentBrandName from the request
        ]);

        // Find equipment with the specified EquipmentBrandName
        $equipment = Equipment::where('EquipmentBrandName', $validated['id'])->get();

        if ($equipment->isEmpty()) {
            return response()->json(['message' => 'No equipment found for the given brand name'], 404);
        }

        $firstBrandName = $equipment->first()->EquipmentBrandName;

        try {
            // Insert all equipment details into the 'equipment_stock'
            foreach ($equipment as $item) {
                EquipmentStock::create([
                    'EquipmentBrandName' => $item->EquipmentBrandName,
                    'EquipmentName' => $item->EquipmentName,
                    'EquipmentCategory' => $item->EquipmentCategory,
                    'EquipmentType' => $item->EquipmentType,
                    'EquipmentColor' => $item->EquipmentColor,
                    'EquipmentUnit' => $item->EquipmentUnit,
                    'EquipmentQuantity' => $item->EquipmentQuantity,
                    'EquipmentControlNo' => $item->EquipmentControlNo,
                    'EquipmentDate' => $item->EquipmentDate,
                    'EquipmentUnitPrice' => $item->EquipmentUnitPrice,
                    'EquipmentClassification' => $item->EquipmentClassification,
                    'EquipmentSKU' => $item->EquipmentSKU,
                    'EquipmentSerialNo' => $item->EquipmentSerialNo,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            // Delete all equipment records with the specified EquipmentBrandName
            Equipment::where('EquipmentBrandName', $firstBrandName)->delete();

            return response()->json(['message' => 'Equipment approved successfully!']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error approving equipment: ' . $e->getMessage()], 500);
        }
    }

}
    
