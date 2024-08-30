<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipment;

class EquipmentController extends Controller
{
    public function index()
    {
        $equipment = Equipment::all();
        return view('admin_equipment', compact('equipment'));
    }

    public function create()
    {
        return view('admin_equipment');
    }

    public function store(Request $request)
    {
        $request->validate([
            'EquipmentName' => 'required|string|max:255',
            'EquipmentCategory' => 'required|string|max:255',
            'EquipmentQuantity' => 'required|integer',
            'EquipmentDate' => 'required|date',
            'EquipmentPrice' => 'required|numeric',
            'EquipmentDepartment' => 'required|string|max:255',
            'EquipmentSKU' => 'required|string|max:255',
        ]);

        $equipment = Equipment::create($request->all());

        return response()->json(['message' => 'Equipment saved successfully!' , 'equipmentId'=> $equipment->id]);
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required|exists:equipment,id',
            'EquipmentName' => 'required|string|max:255',
            'EquipmentCategory' => 'required|string',
            'EquipmentQuantity' => 'required|integer',
            'EquipmentDate' => 'required|date',
            'EquipmentPrice' => 'required|numeric',
            'EquipmentDepartment' => 'required|string',
            'EquipmentSKU' => 'required|string|max:255',
        ]);

        $equipment = Equipment::find($validatedData['id']);
        $equipment->update([
            'EquipmentName' => $validatedData['EquipmentName'],
            'EquipmentCategory' => $validatedData['EquipmentCategory'],
            'EquipmentQuantity' => $validatedData['EquipmentQuantity'],
            'EquipmentDate' => $validatedData['EquipmentDate'],
            'EquipmentPrice' => $validatedData['EquipmentPrice'],
            'EquipmentDepartment' => $validatedData['EquipmentDepartment'],
            'EquipmentSKU' => $validatedData['EquipmentSKU'],
        ]);

        return response()->json(['message' => 'Equipment updated successfully']);
    }

    public function destroy(Request $request)
    {
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
