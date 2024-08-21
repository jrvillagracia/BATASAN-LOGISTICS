<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplies;

class SupplyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $supplies = Supplies::all();
        return view('admin_supplies', compact('supplies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin_supplies');
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

        Supplies::create($request->all());

        // return redirect()->back()->with('success', 'Supply saved successfully.');
    }

    /**
     * Display the specified resource.
     */
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        // $itemId = $request->input('itemID');
    
        // // Find the supplies by ID and delete it
        // $item = Supplies::find($itemId); // For supplies
        // if ($item) {
        //     $item->delete();
        //     return response()->json(['success' => true]);
        // } else {
        //     return response()->json(['error' => 'Item not found'], 404);
        // }
    }
}
