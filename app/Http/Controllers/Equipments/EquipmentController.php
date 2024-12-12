<?php

namespace App\Http\Controllers\Equipments;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Equipments\Equipment;
use App\Models\Equipments\EquipmentStock;

class EquipmentController extends Controller
{
    public function index()
    {
        $equipment = Equipment::select(
            DB::raw('"EquipmentStatus"'),
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
            DB::raw('"EquipmentStatus"'),
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
        ]);

        $validatedData['EquipmentDate'] = Carbon::parse($validatedData['EquipmentDate'])->format('Y-m-d');
    
        // Create a new equipment entry in the database
        for ($i = 0; $i < $validatedData['EquipmentQuantity']; $i++) {
            // Create a new equipment entry in the database

            // Extract the first three letters of the brand name in uppercase
        $brandAbbreviation = strtoupper(substr($request->EquipmentBrandName, 0, 3));
    
        // Find the latest entry for this brand
        $latestEquipment = Equipment::where('EquipmentBrandName', $request->EquipmentBrandName)
                                    ->orderBy('equipmentId', 'desc')
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

          // Check if the serial number exists (if any)
          $serialNo = $request->EquipmentSerialNo ?? null;  
          if ($serialNo) {
              $status = 'COMPLETE'; 
          }

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
                'EquipmentControlNo' => $controlNumber, 
                'EquipmentStatus' => 'PENDING',
            ]);
        }
        
        // Return a response with the control number and success message
        return response()->json([
            'message' => 'Equipment saved successfully!',
            'controlNo' => $controlNumber,
            'equipment' => $equipment,
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
                'equipmentId',
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
                'EquipmentDate',
                'EquipmentSerialNo',
                'EquipmentStatus'
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
                    'equipmentId' => $equipment->equipmentId,
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
                    'EquipmentSerialNo' => $equipment->EquipmentSerialNo,
                    'EquipmentStatus' => $equipment->EquipmentStatus,
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
            'EquipmentQuantity' => (int)$validatedData['EquipmentQuantityEdit'],
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
            'equipmentId' => 'required|integer|exists:equipment,equipmentId',
            'EquipmentSerialNo' => 'required|string|max:255', 
            'FullEquipmentControlNoEdit' => 'required|string|max:255'
        ]);

        $equipment = Equipment::findOrFail($request->input('equipmentId'));

        $equipment->EquipmentSerialNo = $request->input('EquipmentSerialNo');

        $equipment->EquipmentControlNo = $request->input('FullEquipmentControlNoEdit');

        

        $equipment->save();

        // Check if all equipment items of the same brand have a serial number
        $brandName = $equipment->EquipmentBrandName;
        $equipmentItems = Equipment::where('EquipmentBrandName', $brandName)->get();

        // Initialize a flag to track if all items have a serial number
        $allComplete = true;

        foreach ($equipmentItems as $item) {
            if (!$item->EquipmentSerialNo) {
                $allComplete = false;
                break;
            }
        }

        // If all items for the same brand have a serial number, set their status to "COMPLETE"
        if ($allComplete) {
            Equipment::where('EquipmentBrandName', $brandName)
                    ->update(['EquipmentStatus' => 'COMPLETE']);
        } else {
            // If any item is missing a serial number, set status to "PENDING"
            Equipment::where('EquipmentBrandName', $brandName)
                    ->update(['EquipmentStatus' => 'PENDING']);
        }


        return response()->json([
            'message' => 'Equipment updated successfully.',
            'serialNumber' => $request->input('serialNumber'),
            'status' => 'status',
            'equipment' => $equipment
        ]);
    }


    public function destroy(Request $request)
    {
        // Get the brand name from the request
        $brandName = $request->input('brand');

        // Find and delete items with the matching brand name
        $deletedCount = Equipment::where('EquipmentBrandName', $brandName)->delete();

        if ($deletedCount > 0) {
            return response()->json(['success' => 'Items deleted successfully']);
        } else {
            return response()->json(['error' => 'No items found for the given brand']);
        }
    }



    public function destroy2(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'equipmentId' => 'required|integer|exists:equipment,equipmentId',
        ]);

        $equipmentId = $request->input('equipmentId');
        $equipment = Equipment::find($equipmentId);

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

        // Check if any equipment is still in "pending" status
        foreach ($equipment as $item) {
            if ($item->status == 'pending') {
                return response()->json(['message' => 'The equipment has a pending status and cannot be stock-in until approved.'], 400);
            }

            if (empty($item->EquipmentSerialNo)) {
                return response()->json(['message' => 'A serial number is required for stock-in.'], 400);
            }
        }

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
    
