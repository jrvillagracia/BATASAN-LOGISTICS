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
            'EquipmentControlNo' => 'required|string|max:255',
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

        $equipment = Equipment::create($request->all());

        return response()->json(['message' => 'Equipment saved successfully!' , 'equipmentId'=> $equipment->id]);
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required|exists:equipment,id',
            'EquipmentControlNo' => 'required|string|max:255',
            'EquipmentBrandName' => 'required|string|max:255',
            'EquipmentName' => 'required|string|max:255',
            'EquipmentCategory' => 'required|string',
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

        $equipment = Equipment::find($validatedData['id']);
        $equipment->update([
            'EquipmentControlNo' => $validatedData['EquipmentControlNo'],
            'EquipmentBrandName' => $validatedData['EquipmentBrandName'],
            'EquipmentName' => $validatedData['EquipmentName'],
            'EquipmentCategory' => $validatedData['EquipmentCategory'],
            'EquipmentType' => $validatedData['EquipmentType'],
            'EquipmentColor' => $validatedData['EquipmentColor'],
            'EquipmentUnit' => $validatedData['EquipmentUnit'],
            'EquipmentQuantity' => $validatedData['EquipmentQuantity'],
            'EquipmentDate' => $validatedData['EquipmentDate'],
            'EquipmentUnitPrice' => $validatedData['EquipmentUnitPrice'],
            'EquipmentSKU' => $validatedData['EquipmentSKU'],
            'EquipmentSerialNo' => $validatedData['EquipmentSerialNo'],
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
