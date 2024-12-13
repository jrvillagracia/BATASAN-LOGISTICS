<?php

namespace App\Http\Controllers\Equipments;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
//use App\Models\Equipments\Equipment;
use App\Models\Equipments\EquipmentStock;
use App\Http\Controllers\Controller;
//use App\Http\Controllers\Equipments\EquipmentStockController;

class EquipmentStockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
                    'id' => $equipment->equipmentId,
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

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
