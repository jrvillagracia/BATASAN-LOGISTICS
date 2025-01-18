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
        $equipmentStock = EquipmentStock::all();
        $mainteEquipment = MainteEquipment::all();

        $mergedData = $equipmentStock->map(function ($stock) use ($mainteEquipment) {
            $mainte = $mainteEquipment->firstWhere('mainteEquipmentId', $stock->equipmentStockId);

            return [
                'EquipmentBrandName' => $stock->EquipmentBrandName,
                'EquipmentName' => $stock->EquipmentName,
                'EquipmentCategory' => $stock->EquipmentCategory,
                'EquipmentSKU' => $stock->EquipmentSKU,
                'EquipmentColor' => $stock->EquipmentColor,
                'EquipmentType' => $stock->EquipmentType,
                'EquipmentSerialNo' => $stock->EquipmentSerialNo,
                'EquipmentControlNo' => $stock->EquipmentControlNo,
                'mainteRepairId' => $mainte ? $mainte->mainteRepairId : null,
                'MainteEquipDate' => $mainte ? $mainte->MainteEquipDate : null,
                'MainteEquipTime' => $mainte ? $mainte->MainteEquipTime : null,
                'MainteEquipReqUnit' => $mainte ? $mainte->MainteEquipReqUnit : null,
                'MainteEquipReqFOR' => $mainte ? $mainte->MainteEquipReqFOR : null,
            ];
        });

        Log::info('Merged Equipment Data:', $mergedData->toArray());

        $equipment = $mergedData->all();
        Log::info('Final Equipment Data Passed to View:', $equipment);

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

    public function store (Request $request)
    {
        $validatedData = $request->validate([
            'MainteEquipDate' => 'required|date_format:Y-m-d',
            'MainteEquipTime' => 'required|date_format:H:i',
            'MainteEquipReqUnit' => 'required|string|max:255',
            'MainteEquipReqFOR' => 'required|string|max:255',
        ]);

        $lastEquipment = MainteEquipment::orderBy('mainteRepairId', 'desc')->first();
        $lastRepairId = $lastEquipment ? $lastEquipment->mainteRepairId : null;

        if ($lastRepairId) {
            $lastNumber = (int) substr($lastRepairId, 3);
            $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '001';
        }

        $newRepairId = 'EQRPR' . $newNumber;
        $validatedData['mainteRepairId'] = $newRepairId;

        MainteEquipment::create($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Equipment request created successfully.',
            'data' => $validatedData
        ]);
    }

}
