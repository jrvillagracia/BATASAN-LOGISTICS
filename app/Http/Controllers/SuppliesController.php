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

        Supplies::create($request->all());

        return response()->json(['message' => 'Item saved successfully!']);
    }

}
