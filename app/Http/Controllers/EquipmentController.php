<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EquipmentController extends Controller
{
    public function index()
    {
        $equipment = Equipment::select(
                'EquipmentBrandName',
                'EquipmentName',
                'EquipmentCategory',
                'EquipmentSKU',
                'EquipmentQuantity',
                DB::raw('COUNT(*) as EquipmentQuantity'),
                DB::raw('SUM(COALESCE(EquipmentUnitPrice, 0) * COALESCE(EquipmentQuantity, 0)) AS totalPrice'),
                DB::raw('COUNT(*) as totalItems') 
            )
            ->groupBy('EquipmentBrandName', 'EquipmentName', 'EquipmentCategory', 'EquipmentSKU', 'EquipmentQuantity')
            ->get();
            

        return view('admin_equipment', compact('equipment'));
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
        return view('admin_equipment');
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
                'EquipmentSerialNo',
                'EquipmentBrandName',
                'EquipmentName',
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
                    'EquipmentSerialNo' => $equipment->EquipmentSerialNo,
                    'EquipmentBrandName' => $equipment->EquipmentBrandName,
                    'EquipmentName' => $equipment->EquipmentName,
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
        Log::info('Incoming request data for Main Edit:', $request->all());
    
        // Validate the incoming request data for the main table
        $validatedData = $request->validate([
            'EquipmentBrandName' => 'required|string|max:255',
            'EquipmentName' => 'required|string|max:255',
            'EquipmentCategory' => 'required|string',
            'EquipmentSKU' => 'required|string|max:255',
            'brand' => 'required|string|max:255', // Ensure brand is validated
        ]);
    
        // Update the equipment based on the brand
        $updateCount = Equipment::where('EquipmentBrandName', $validatedData['brand'])->update([
            'EquipmentBrandName' => $validatedData['EquipmentBrandName'],
            'EquipmentName' => $validatedData['EquipmentName'],
            'EquipmentCategory' => $validatedData['EquipmentCategory'],
            'EquipmentSKU' => $validatedData['EquipmentSKU'], // Fixed typo from 'EquipmenntSKU'
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
            'FullEquipmentSerialNoEdit' => 'required|string|max:255',
            'FullEquipmentControlNoEdit' => 'required|string|max:255',
            'FullEquipmentTypeEdit' => 'required|string|max:255',
            'FullEquipmentColorEdit' => 'required|string|max:255',
            'FullEquipmentUnitEdit' => 'required|string|max:255',
            'FullEquipmentUnitPriceEdit' => 'required|numeric',
            'FullEquipmentClassificationEdit' => 'required|string|max:255',
            'FullEquipmentDateEdit' => 'required|date',
        ]);

        $equipment = Equipment::findOrFail($request->input('id'));

        $equipment->EquipmentSerialNo = $request->input('FullEquipmentSerialNoEdit');
        $equipment->EquipmentControlNo = $request->input('FullEquipmentControlNoEdit');
        $equipment->EquipmentType = $request->input('FullEquipmentTypeEdit');
        $equipment->EquipmentColor = $request->input('FullEquipmentColorEdit');
        $equipment->EquipmentUnit = $request->input('FullEquipmentUnitEdit');
        $equipment->EquipmentUnitPrice = $request->input('FullEquipmentUnitPriceEdit');
        $equipment->EquipmentClassification = $request->input('FullEquipmentClassificationEdit');
        $equipment->EquipmentDate = $request->input('FullEquipmentDateEdit');

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


    public function destroyEdit2(Request $request)
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
}

    
