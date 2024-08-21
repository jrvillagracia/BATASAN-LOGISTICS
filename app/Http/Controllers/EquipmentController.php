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

        Equipment::create($request->all());

        return response()->json(['message' => 'Item saved successfully!']);
    }
}
