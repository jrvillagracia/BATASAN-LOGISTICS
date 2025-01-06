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
            'EquipmentUnitPrice' => 'required|numeric|max:100000',
            'EquipmentClassification' => 'required|string',
            'EquipmentSKU' => 'required|string|max:255',
        ]);

        $validatedData['EquipmentDate'] = Carbon::parse($validatedData['EquipmentDate'])->format('Y-m-d');

        // Check if an entry with the same category, type, unit, and brand name already exists
        $existingEquipment = Equipment::where('EquipmentBrandName', $validatedData['EquipmentBrandName'])
            ->where('EquipmentCategory', $validatedData['EquipmentCategory'])
            ->where('EquipmentType', $validatedData['EquipmentType'])
            ->where('EquipmentUnit', $validatedData['EquipmentUnit'])
            ->first();

        if ($existingEquipment) {
            // If a match is found, merge by updating the quantity
            $existingEquipment->EquipmentQuantity += $validatedData['EquipmentQuantity'];
            $existingEquipment->save();

            return response()->json([
                'message' => 'Equipment merged successfully!',
                'equipment' => $existingEquipment,
            ]);
        } else {
            // If no match is found, create a new entry for each quantity
            for ($i = 0; $i < $validatedData['EquipmentQuantity']; $i++) {
                // Generate a control number
                $brandAbbreviation = strtoupper(substr($validatedData['EquipmentBrandName'], 0, 3));
                $latestEquipment = Equipment::where('EquipmentBrandName', $validatedData['EquipmentBrandName'])
                    ->orderBy('equipmentId', 'desc')
                    ->first();

                if ($latestEquipment) {
                    $latestControlNo = $latestEquipment->EquipmentControlNo;
                    $latestNumber = (int) substr($latestControlNo, -4);
                    $newNumber = $latestNumber + 1;
                } else {
                    $newNumber = 1;
                }

                $controlNumber = $brandAbbreviation . '-' . str_pad($newNumber, 4, '0', STR_PAD_LEFT);

                // Create a new equipment entry
                $equipment = Equipment::create([
                    'EquipmentBrandName' => $validatedData['EquipmentBrandName'],
                    'EquipmentName' => $validatedData['EquipmentName'],
                    'EquipmentCategory' => $validatedData['EquipmentCategory'],
                    'EquipmentType' => $validatedData['EquipmentType'],
                    'EquipmentColor' => $validatedData['EquipmentColor'],
                    'EquipmentUnit' => $validatedData['EquipmentUnit'],
                    'EquipmentQuantity' => 1,
                    'EquipmentDate' => $validatedData['EquipmentDate'],
                    'EquipmentUnitPrice' => $validatedData['EquipmentUnitPrice'],
                    'EquipmentClassification' => $validatedData['EquipmentClassification'],
                    'EquipmentSKU' => $validatedData['EquipmentSKU'],
                    'EquipmentControlNo' => $controlNumber,
                    'EquipmentStatus' => 'PENDING',
                ]);
            }

            return response()->json([
                'message' => 'New equipment entry created successfully!',
                'equipment' => $equipment,
            ]);
        }
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
        Log::info('Incoming request data for Main:', $request->all());
    
        // Validate the incoming request data for the main table
        $validatedData = $request->validate([
            'EquipmentBrandNameEdit' => 'required|string|max:255',
            'EquipmentNameEdit' => 'required|string|max:255',
            'EquipmentCategoryEdit' => 'required|string',
            'otherEquipCategoryEdit' => 'nullable|required_if:EquipmentCategoryEdit,other|string|max:255',
            'EquipmentQuantityEdit' => 'required|integer',
            'EquipmentColorEdit' => 'required|string|max:255',
            'EquipmentTypeEdit' => 'required|string|max:255',
            'EquipmentUnitEdit' => 'required|string|max:255',
            'EquipmentUnitPriceEdit' => 'required|numeric',
            'EquipmentClassificationEdit' => 'required|string|max:255',
            'EquipmentSKUEdit' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'oldname' => 'required|string|max:255',
        ]);
    
        $category = $validatedData['EquipmentCategoryEdit'];
        if ($category === 'other' && !empty($validatedData['otherEquipCategoryEdit'])) {
            $category = $validatedData['otherEquipCategoryEdit'];
        }
    
        // Find the current equipment entry from the database
        $equipment = Equipment::where('EquipmentBrandName', $validatedData['brand'])
                            ->where('EquipmentName', $validatedData['oldname'])
                            ->first();
    
        if (!$equipment) {
            return response()->json(['message' => 'Equipment not found'], 404);
        }
    
        $currentQuantity = $equipment->EquipmentQuantity;
        $newQuantity = $validatedData['EquipmentQuantityEdit'];
    
        // Calculate the difference between the new quantity and the current quantity
        $quantityDifference = $newQuantity - $currentQuantity;
    
        // If the new quantity is greater than the current quantity, create new entries for the difference
        if ($quantityDifference > 0) {
            // Create new entries based on the quantity difference
            for ($i = 0; $i < $quantityDifference; $i++) {
                // Generate control number for the new entry
                $brandAbbreviation = strtoupper(substr($validatedData['EquipmentBrandNameEdit'], 0, 3));
                $latestEquipment = Equipment::where('EquipmentBrandName', $validatedData['EquipmentBrandNameEdit'])
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
    
                // Create the new equipment entry with the new control number and automatically set the current date for EquipmentDate
                Equipment::create([
                    'EquipmentBrandName' => $validatedData['EquipmentBrandNameEdit'],
                    'EquipmentName' => $validatedData['EquipmentNameEdit'],
                    'EquipmentCategory' => $category,
                    'EquipmentQuantity' => 1, // Each new entry has a quantity of 1
                    'EquipmentColor' => $validatedData['EquipmentColorEdit'],
                    'EquipmentType' => $validatedData['EquipmentTypeEdit'],
                    'EquipmentUnit' => $validatedData['EquipmentUnitEdit'],
                    'EquipmentUnitPrice' => $validatedData['EquipmentUnitPriceEdit'],
                    'EquipmentClassification' => $validatedData['EquipmentClassificationEdit'],
                    'EquipmentSKU' => $validatedData['EquipmentSKUEdit'],
                    'EquipmentControlNo' => $controlNumber,
                    'EquipmentStatus' => 'PENDING',
                    'EquipmentDate' => Carbon::now(), // Automatically set to the current date and time
                ]);
            }
        }
    
        // Update the main equipment entry with the new details
        $equipment->update([
            'EquipmentBrandName' => $validatedData['EquipmentBrandNameEdit'],
            'EquipmentName' => $validatedData['EquipmentNameEdit'],
            'EquipmentCategory' => $category,
            'EquipmentQuantity' => $newQuantity, // Update the quantity
            'EquipmentColor' => $validatedData['EquipmentColorEdit'],
            'EquipmentType' => $validatedData['EquipmentTypeEdit'],
            'EquipmentUnit' => $validatedData['EquipmentUnitEdit'],
            'EquipmentUnitPrice' => $validatedData['EquipmentUnitPriceEdit'],
            'EquipmentClassification' => $validatedData['EquipmentClassificationEdit'],
            'EquipmentSKU' => $validatedData['EquipmentSKUEdit'],
            'EquipmentDate' => Carbon::now(), // Update EquipmentDate with the current date and time
        ]);
    
        return response()->json(['message' => 'Equipment updated successfully in Main Table', 'equipment' => $equipment]);
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
        // Validate the incoming request
        $validatedData = $request->validate([
            'EquipmentName' => 'required|string',
        ]);

        // Get the equipment name from the request
        $equipmentName = $validatedData['EquipmentName'];

        // Find and delete all items with the matching equipment name
        $deletedCount = Equipment::where('EquipmentName', $equipmentName)->delete();

        if ($deletedCount > 0) {
            return response()->json(['message' => 'Items deleted successfully!']);
        } else {
            return response()->json(['message' => 'No items found for the given equipment name.'], 404);
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

        // Retrieve equipment records by brand name
        $equipment = Equipment::where('EquipmentBrandName', $validated['id'])->get();

        // Check if any records were found
        if ($equipment->isEmpty()) {
            return response()->json(['message' => 'No equipment found for the given brand name'], 404);
        }

        // Validate statuses and serial numbers
        foreach ($equipment as $item) {
            if ($item->status == 'pending') {
                return response()->json(['message' => 'Some equipment is pending approval.'], 400);
            }

            if (empty($item->EquipmentSerialNo)) {
                return response()->json(['message' => 'A serial number is required for all equipment.'], 400);
            }
        }

        try {
            // Begin transaction
            DB::beginTransaction();

            // Insert all equipment details into 'equipment_stocks' using equipmentId as the primary key
            foreach ($equipment as $item) {
                EquipmentStock::create([
                    'equipmentId' => $item->equipmentId, // Use equipmentId as the primary key
                    'EquipmentControlNo' => $item->EquipmentControlNo,
                    'EquipmentBrandName' => $item->EquipmentBrandName,
                    'EquipmentName' => $item->EquipmentName,
                    'EquipmentCategory' => $item->EquipmentCategory,
                    'EquipmentType' => $item->EquipmentType,
                    'EquipmentColor' => $item->EquipmentColor,
                    'EquipmentUnit' => $item->EquipmentUnit,
                    'EquipmentQuantity' => $item->EquipmentQuantity,
                    'EquipmentDate' => $item->EquipmentDate,
                    'EquipmentUnitPrice' => $item->EquipmentUnitPrice,
                    'EquipmentClassification' => $item->EquipmentClassification,
                    'EquipmentSKU' => $item->EquipmentSKU,
                    'EquipmentSerialNo' => $item->EquipmentSerialNo,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            // Delete all equipment records with the specified brand name
            Equipment::where('EquipmentBrandName', $validated['id'])->delete();

            // Commit transaction
            DB::commit();

            return response()->json(['message' => 'Equipment approved successfully!']);
        } catch (\Exception $e) {
            // Rollback transaction in case of an error
            DB::rollBack();
            return response()->json(['message' => 'Error approving equipment: ' . $e->getMessage()], 500);
        }
    }


}
    
