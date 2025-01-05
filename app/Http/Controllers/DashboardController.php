<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Equipments\Equipment;
use App\Models\Equipments\EquipmentStock;
use App\Models\Models\FacilityModule\Room;


class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Count the total number of facilities
        $totalFacilities = Room::count();

        // $totalEquipmentStocks = DB::table('equipment_stocks')->count();
        $totalEquipmentStocks = EquipmentStock::count();

        // Pass the totalFacilities variable to the Blade view
        return view('adminPages.admin_dashboard', compact('totalFacilities', 'totalEquipmentStocks'));
    }

    public function getEquipmentPerMonth(Request $request)
    {
        $equipmentPerMonth = Equipment::selectRaw('COUNT(*) as count, EXTRACT(MONTH FROM "EquipmentDate") as month')
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get();

        $months = [];
        $counts = [];

        foreach ($equipmentPerMonth as $data) {
            $months[] = Carbon::create()->month((int) $data->month)->format('M'); // Month name
            $counts[] = $data->count; // Equipment count
        }

        // Return JSON response
        return response()->json([
            'months' => $months,
            'counts' => $counts,
        ]);
    }
}
