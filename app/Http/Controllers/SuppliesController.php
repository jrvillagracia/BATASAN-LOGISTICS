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
            'SuppliesControlNo' => 'required|string|max:255',
            'SuppliesBrandName' => 'required|string|max:255',
            'SuppliesName' => 'required|string|max:255',
            'SuppliesCategory' => 'required|string|max:255',
            'SuppliesType' => 'required|string|max:255',
            'SuppliesColor' => 'required|string|max:255',
            'SuppliesUnit' => 'required|string|max:255',
            'SuppliesQuantity' => 'required|integer',
            'SuppliesDate' => 'required|date',
            'SuppliesUnitPrice' => 'required|numeric',
            'SuppliesClassification' => 'required|string|max:255',
            'SuppliesSKU' => 'required|string|max:255',
            'SuppliesSerialNo' => 'required|string|max:255',
        ]);

        $supplies = Supplies::create($request->all());

        return response()->json(['message' => 'Item saved successfully!', 'suppliesId'=> $supplies->id]);
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required|exists:supplies,id',
            'SuppliesControlNo' => 'required|string|max:255',
            'SuppliesBrandName' => 'required|string|max:255',
            'SuppliesName' => 'required|string|max:255',
            'SuppliesCategory' => 'required|string',
            'SuppliesType' => 'required|string|max:255',
            'SuppliesColor' => 'required|string|max:255',
            'SuppliesUnit' => 'required|string|max:255',
            'SuppliesQuantity' => 'required|integer',
            'SuppliesDate' => 'required|date',
            'SuppliesUnitPrice' => 'required|numeric',
            'SuppliesClassification' => 'required|string|max:255',
            'SuppliesSKU' => 'required|string|max:255',
            'SuppliesSerialNo' => 'required|string|max:255',
        ]);

        $Supplies = Supplies::find($validatedData['id']);
        $Supplies->update([
            'SuppliesControlNo' => $validatedData['SuppliesControlNo'],
            'SuppliesBrandName' => $validatedData['SuppliesBrandName'],
            'SuppliesName' => $validatedData['SuppliesName'],
            'SuppliesCategory' => $validatedData['SuppliesCategory'],
            'SuppliesType' => $validatedData['SuppliesType'],
            'SuppliesColor' => $validatedData['SuppliesColor'],
            'SuppliesUnit' => $validatedData['SuppliesUnit'],
            'SuppliesQuantity' => $validatedData['SuppliesQuantity'],
            'SuppliesDate' => $validatedData['SuppliesDate'],
            'SuppliesUnitPrice' => $validatedData['SuppliesUnitPrice'],
            'SuppliesClassification' => $validatedData['SuppliesClassification'],
            'SuppliesSKU' => $validatedData['SuppliesSKU'],
            'SuppliesSerialNo' => $validatedData['SuppliesSerialNo'],
        ]);

        return response()->json(['message' => 'Supplies updated successfully']);
    }

    public function destroy(Request $request)
    {
        $id = $request->input('id');
        $supplies = Supplies::find($id);

        if ($supplies) {
            $supplies->delete();
            return response()->json(['message' => 'Supplies item deleted successfully.'], 200);
        } else {
            return response()->json(['message' => 'Supplies item not found.'], 404);
        }
    }
}
