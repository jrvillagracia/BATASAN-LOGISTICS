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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin_equipment');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'productName' => 'required|string|max:255',
            'productCategory' => 'required|string|max:255',
            'productQuantity' => 'required|integer',
            'productDate' => 'required|date',
            'productPrice' => 'required|numeric',
            'productDepartment' => 'required|string|max:255',
            'productSKU' => 'required|string|max:255',
        ]);

        Equipment::create($request->all());

        return response()->json(['message' => 'Item saved successfully!']);
    }

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

    
    public function destroy(Request $request)
    {
        $itemId = $request->input('itemID');
    
        // Find the equipment by ID and delete it
        $item = Equipment::find($itemId); // For equipment
        if ($item) {
            $item->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['error' => 'Item not found'], 404);
        }
    }
}