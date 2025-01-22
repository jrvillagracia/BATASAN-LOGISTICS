<?php

namespace App\Http\Controllers\MaintenanceFacility;

use App\Http\Controllers\Controller;
use App\Models\MaintenanceFacility\MainteEquipment;
use App\Models\Models\FacilityModule\Room;
use App\Models\Equipments\EquipmentStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MainteEquipmentController extends Controller
{
    public function index()
    {
        $equipment = MainteEquipment::with('equipmentStock')->get();
        return view('adminPages.admin_mainteEquipment', compact('equipment'));
    }

    public function create ()
    {
        return view('adminPages.admin_mainteEquipment_create');
    }

    public function showDetails()
    {
        $equipment = EquipmentStock::all();
        $rooms = Room::select('BldName', 'Room')->get();

        // Merge equipment with rooms
        $mergedData = $equipment->map(function ($item) use ($rooms) {
            return $rooms->map(function ($room) use ($item) {
                return [
                    'EquipmentBrandName' => $item->EquipmentBrandName,
                    'EquipmentName' => $item->EquipmentName,
                    'EquipmentCategory' => $item->EquipmentCategory,
                    'EquipmentSKU' => $item->EquipmentSKU,
                    'EquipmentColor' => $item->EquipmentColor,
                    'EquipmentType' => $item->EquipmentType,
                    'EquipmentSerialNo' => $item->EquipmentSerialNo,
                    'EquipmentControlNo' => $item->EquipmentControlNo,
                    'BldName' => $room->BldName,
                    'Room' => $room->Room,
                ];
            });
        })->collapse(); // Collapse nested collections into one flat collection

        $equipment = $mergedData->all();
        return view('adminPages.admin_mainteEquipment', compact('equipment'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'MainteEquipDate' => 'required|date_format:Y-m-d',
            'MainteEquipTime' => 'required|date_format:H:i',
            'MainteEquipReqUnit' => 'required|string|max:255',
            'MainteEquipReqFOR' => 'required|string|max:255',
            'equipmentStockId' => 'required|integer|exists:equipment_stocks,id',  // Validate that the equipment exists
        ]);

        // Retrieve the equipment details associated with the provided equipmentStockId
        $equipment = EquipmentStock::find($validatedData['equipmentStockId']);
        
        if (!$equipment) {
            return response()->json([
                'success' => false,
                'message' => 'Equipment not found.'
            ]);
        }

        // Generate the new mainteRepairId based on the last entry
        $lastEquipment = MainteEquipment::orderBy('mainteEquipmentId', 'desc')->first();
        $lastRepairId = $lastEquipment ? $lastEquipment->mainteRepairId : null;

        if ($lastRepairId) {
            $lastNumber = (int) substr($lastRepairId, 3);
            $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '001';
        }

        $newRepairId = 'RPR' . $newNumber;

        // Add the new mainteRepairId and the equipment details to the validated data
        $validatedData['mainteEquipmentId'] = $newRepairId;
        $validatedData['equipmentBrandName'] = $equipment->EquipmentBrandName;  // Example of adding equipment details
        $validatedData['equipmentName'] = $equipment->EquipmentName;            // Example of adding equipment details

        // Create the new MainteEquipment record
        MainteEquipment::create($validatedData);

        // Return a success response
        return response()->json([
            'success' => true,
            'message' => 'Equipment request created successfully.',
            'data' => $validatedData
        ]);
    }


    public function getEquipmentDetails(Request $request)
    {
        // Fetch the equipment record based on SerialNo and ControlNo
        $equipment = Equipment::where('SerialNo', $request->SerialNo)
            ->where('ControlNo', $request->ControlNo)
            ->first();

        if ($equipment) {
            return response()->json([
                'success' => true,
                'equipmentStockId' => $equipment->equipmentStockId,
                'EquipmentBrandName' => $equipment->EquipmentBrandName,
                'EquipmentName' => $equipment->EquipmentName,
                'EquipmentCategory' => $equipment->EquipmentCategory,
                'EquipmentType' => $equipment->EquipmentType,
                'EquipmentColor' => $equipment->EquipmentColor,
                'EquipmentUnit' => $equipment->EquipmentUnit,
                'EquipmentQuantity' => $equipment->EquipmentQuantity,
                'EquipmentUnitPrice' => $equipment->EquipmentUnitPrice,
                'EquipmentDepartment' => $equipment->EquipmentDepartment,
                'EquipmentClassification' => $equipment->EquipmentClassification,
                'EquipmentSKU' => $equipment->EquipmentSKU,
                'EquipmentSerialNo' => $equipment->EquipmentSerialNo,
                // Add any other columns you need
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Equipment not found'
            ]);
        }
    }


}
