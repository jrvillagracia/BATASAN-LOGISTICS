<?php

namespace App\Http\Controllers\Equipments;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Equipments\EquipCondem;
use Illuminate\Support\Facades\Response;
use App\Models\Equipments\EquipmentStock;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class EquipmentStockController extends Controller
{
    public function index()
    {
        $equipment = EquipmentStock::select(
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
            
        return view('adminPages.admin_equipment', compact('equipment'));
    }

    public function equipmentDetails(Request $request)
    {
        // Get the equipment brand name from the request
        $brandName = $request->input('EquipmentBrandName');

        if (!$brandName) {
            return response()->json(['message' => 'Brand name is required'], 400);
        }

        // Fetch equipment details that match the brand name
        $equipmentDetails = EquipmentStock::select(
                'equipmentStockId',
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
                    'equipmentStockId' => $equipment->equipmentStockId,
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
                ];
            })
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
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
            'EquipmentUnitPrice' => 'required|numeric',
            'EquipmentClassification' => 'required|string|max:255',
            'EquipmentSKU' => 'required|string|max:255',
            'EquipmentSerialNo' => 'required|string|max:255',
        ]);
    
        // Create a new equipment entry in the database
        for ($i = 0; $i < $validatedData['EquipmentQuantity']; $i++) {
            // Create a new equipment entry in the database

            // Extract the first three letters of the brand name in uppercase
        $brandAbbreviation = strtoupper(substr($request->EquipmentBrandName, 0, 3));
    
        // Find the latest entry for this brand
        $latestEquipment = EquipmentStock::where('EquipmentBrandName', $request->EquipmentBrandName)
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

            $equipment = EquipmentStock::create([
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
                'EquipmentSerialNo' => $validatedData['EquipmentSerialNo'],
                'EquipmentControlNo' => $controlNumber, // Save the generated control number
            ]);
        }
        
        // Return a response with the control number and success message
        return response()->json([
            'message' => 'Equipment saved successfully!',
            'controlNo' => $controlNumber, // Return the control number
            'equipment' => $equipment, // Optional: return the equipment details
        ]);
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'EQUIPMENTBrandNameEDT' => 'required|string|max:255',
            'EQUIPMENTNameEDT' => 'required|string|max:255',
            'EQUIPMENTCategoryEDT' => 'required|string',
            'otherEQUIPMENTCategoryEDT' => 'nullable|required_if:EQUIPMENTCategoryEDT,other|string|max:255',
            'EQUIPMENTQuantityEDT' => 'required|integer',
            'EQUIPMENTSKUEDT' => 'required|string|max:255',
            'EQUIPMENTColorEDT' => 'required|string|max:255',
            'EQUIPMENTTypeEDT' => 'required|string|max:255',
            'EQUIPMENTUnitEDT' => 'required|string|max:255',
            'EQUIPMENTUnitPriceEDT' => 'required|numeric',
            'EQUIPMENTClassificationEDT' => 'required|string|max:255',
            'oldbrandName' => 'required|string|max:255',
            'oldName' => 'required|string|max:255',
        ]);

         $category = $validatedData['EQUIPMENTCategoryEDT'];
        if ($category === 'other' && !empty($validatedData['otherEQUIPMENTCategoryEDT'])) {
            $category = $validatedData['otherEQUIPMENTCategoryEDT'];
        }

        // Find the current equipment entry from the database using old values
        $equipment = EquipmentStock::where('EquipmentBrandName', $validatedData['oldbrandName'])
            ->where('EquipmentName', $validatedData['oldName'])
            ->first();

        if (!$equipment) {
            return response()->json(['message' => 'Equipment not found', 'EquipmentBrandName'=> $validatedData['EQUIPMENTBrandNameEDT'], 'EquipmentName'=>$validatedData['EQUIPMENTNameEDT']], 404);
        }

        $currentQuantity = $equipment->EquipmentQuantity;
        $newQuantity = $validatedData['EQUIPMENTQuantityEDT'];

        // Condition to check if the new quantity is less than the current quantity
        if ($newQuantity < $currentQuantity) {
            return response()->json([
                'message' => "Can't edit quantity to less than the current value ($currentQuantity)."
            ], 400);
        }

        // If the new quantity is greater than the current quantity, update the quantity
        if ($newQuantity > $currentQuantity) {
            $quantityDifference = $newQuantity - $currentQuantity;

            // Update the quantity of the existing entry
            $equipment->update([
                'EquipmentQuantity' => $newQuantity,
            ]);
        } else if ($newQuantity < $currentQuantity) {
            // If the new quantity is less than the current quantity, delete the excess entries
            $quantityDifference = $currentQuantity - $newQuantity;

            // Delete the excess entries based on the quantity difference
            EquipmentStock::where('EquipmentBrandName', $validatedData['EQUIPMENTBrandNameEDT'])
                ->where('EquipmentName', $validatedData['EQUIPMENTNameEDT'])
                ->orderBy('equipmentStockId', 'desc')
                ->take($quantityDifference)
                ->delete();
        }

        // Update the main equipment entry with the new details
        $equipment->update([
            'EquipmentBrandName' => $validatedData['EQUIPMENTBrandNameEDT'],
            'EquipmentName' => $validatedData['EQUIPMENTNameEDT'],
            'EquipmentCategory' => $category,
            'EquipmentQuantity' => $validatedData['EQUIPMENTQuantityEDT'],
            'EquipmentColor' => $validatedData['EQUIPMENTColorEDT'],
            'EquipmentType' => $validatedData['EQUIPMENTTypeEDT'],
            'EquipmentUnit' => $validatedData['EQUIPMENTUnitEDT'],
            'EquipmentUnitPrice' => $validatedData['EQUIPMENTUnitPriceEDT'],
            'EquipmentClassification' => $validatedData['EQUIPMENTClassificationEDT'],
            'EquipmentSKU' => $validatedData['EQUIPMENTSKUEDT'],
            'EquipmentDate' => Carbon::now(),
        ]);

        return response()->json(['message' => 'Equipment updated successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    public function destroyStock(Request $request)
    {
        // Validate the request input
        $request->validate([
            'brand' => 'required|string',
        ]);

        // Get the brand name from the request
        $brandName = $request->input('brand');

        // Find and delete items with the matching brand name
        $deletedCount = EquipmentStock::where('EquipmentBrandName', $brandName)->delete();

        if ($deletedCount > 0) {
            return response()->json(['message' => 'Items deleted successfully']);
        } else {
            return response()->json(['message' => 'No items found for the given brand'], 404);
        }
    }

    public function condemnEquipment(Request $request)
    {
        // Get all selected equipment items from the request
        $selectedItems = $request->input('equipment_ids');

        // Validate the selected items array
        if (empty($selectedItems)) {
            return response()->json(['error' => 'Please select at least one item to condemn.'], 400);
        }

        // Loop through each selected item and condemn it
        foreach ($selectedItems as $equipmentStockId) {
            // Fetch the equipment data by equipmentStockId
            $equipment = EquipmentStock::where('equipmentStockId', $equipmentStockId)->first();

            if ($equipment) {
                // Create a new record in the equipcondem table
                EquipCondem::create([
                    'equipmentStockId' => $equipment->equipmentStockId,
                    'EquipmentControlNo' => $equipment->EquipmentControlNo,
                    'EquipmentBrandName' => $equipment->EquipmentBrandName,
                    'EquipmentName' => $equipment->EquipmentName,
                    'EquipmentCategory' => $equipment->EquipmentCategory,
                    'EquipmentType' => $equipment->EquipmentType,
                    'EquipmentColor' => $equipment->EquipmentColor,
                    'EquipmentUnit' => $equipment->EquipmentUnit,
                    'EquipmentQuantity' => $equipment->EquipmentQuantity,
                    'EquipmentDate' => $equipment->EquipmentDate,
                    'EquipmentUnitPrice' => $equipment->EquipmentUnitPrice,
                    'EquipmentClassification' => $equipment->EquipmentClassification,
                    'EquipmentSKU' => $equipment->EquipmentSKU,
                    'EquipmentSerialNo' => $equipment->EquipmentSerialNo,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // Log the deletion process
                \Log::info('Condemning equipment with ID: ' . $equipment->equipmentStockId);

                // Delete the equipment from the EquipmentStock table
                $equipment->delete();
            }
        }

        return response()->json(['success' => true, 'message' => 'Selected items have been condemned successfully.']);
    }

}
