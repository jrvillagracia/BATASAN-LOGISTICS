<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplies;

class SuppliesController extends Controller
{
    public function index()
    {
        $supplies = Supplies::all();
        return view('admin_supplies', compact('supplies'));
    }

    public function create()
    {
        return view('admin_supplies');
    }

    public function store(Request $request)
    {
        $request->validate([
            'SuppliesName' => 'required|string|max:255',
            'SuppliesCategory' => 'required|string|max:255',
            'SuppliesQuantity' => 'required|integer',
            'SuppliesDate' => 'required|date',
            'SuppliesPrice' => 'required|numeric',
            'SuppliesDepartment' => 'required|string|max:255',
            'SuppliesSKU' => 'required|string|max:255',
        ]);

        $supplies = Supplies::create($request->all());

        return response()->json(['message' => 'Item saved successfully!', 'suppliesId'=> $supplies->id]);
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required|exists:supplies,id',
            'SuppliesName' => 'required|string|max:255',
            'SuppliesCategory' => 'required|string',
            'SuppliesQuantity' => 'required|integer',
            'SuppliesDate' => 'required|date',
            'SuppliesPrice' => 'required|numeric',
            'SuppliesDepartment' => 'required|string',
            'SuppliesSKU' => 'required|string|max:255',
        ]);

        $Supplies = Supplies::find($validatedData['id']);
        $Supplies->update([
            'SuppliesName' => $validatedData['SuppliesName'],
            'SuppliesCategory' => $validatedData['SuppliesCategory'],
            'SuppliesQuantity' => $validatedData['SuppliesQuantity'],
            'SuppliesDate' => $validatedData['SuppliesDate'],
            'SuppliesPrice' => $validatedData['SuppliesPrice'],
            'SuppliesDepartment' => $validatedData['SuppliesDepartment'],
            'SuppliesSKU' => $validatedData['SuppliesSKU'],
        ]);

        return response()->json(['message' => 'Supplies updated successfully']);
    }

    public function destroy(Request $request)
    {
        $id = $request->input('id');
        $supplies = Supplies::find($id);

        if ($supplies) {
            $supplies->delete();
            return response()->json(['message' => 'Equipment item deleted successfully.'], 200);
        } else {
            return response()->json(['message' => 'Equipment item not found.'], 404);
        }
    }
}
