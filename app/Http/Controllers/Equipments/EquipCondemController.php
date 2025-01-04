<?php

namespace App\Http\Controllers\Equipments;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Equipments\EquipCondem;

class EquipCondemController extends Controller
{
    public function index()
    {
        $equipment = EquipCondem::select(
            DB::raw('"EquipmentBrandName"'),
            DB::raw('"EquipmentName"'),
            DB::raw('"EquipmentCategory"'),
            DB::raw('"EquipmentClassification"'),
            DB::raw('"EquipmentColor"'),
            DB::raw('"EquipmentType"'),
            DB::raw('"EquipmentUnit"'),
            DB::raw('"EquipmentUnitPrice"'),
            DB::raw('"EquipmentDate"'),
            DB::raw('"EquipmentSKU"'),
            DB::raw('SUM(COALESCE("EquipmentQuantity", 0)) AS "EquipmentQuantity"'),
            DB::raw('SUM(COALESCE("EquipmentUnitPrice", 0) * COALESCE("EquipmentQuantity", 0)) AS "totalPrice"'),
            DB::raw('COUNT(*) AS "totalItems"')
        )
        ->groupBy(
            DB::raw('"EquipmentBrandName"'),
            DB::raw('"EquipmentName"'),
            DB::raw('"EquipmentCategory"'),
            DB::raw('"EquipmentClassification"'),
            DB::raw('"EquipmentColor"'),
            DB::raw('"EquipmentType"'),
            DB::raw('"EquipmentUnit"'),
            DB::raw('"EquipmentUnitPrice"'),
            DB::raw('"EquipmentDate"'),
            DB::raw('"EquipmentSKU"')
        )
        ->get();
            
        return view('adminPages.admin_equipCondemned', compact('equipment'));
    }

}
