<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Events\Events;
use App\Models\Supplies\Supplies;
use Illuminate\Support\Facades\DB;
use App\Models\Equipments\Equipment;
use App\Models\Supplies\SuppliesStock;
use App\Models\Equipments\EquipmentStock;
use App\Models\Models\FacilityModule\Room;
use App\Models\MaintenanceFacility\MainteFacility;
use App\Models\MaintenanceFacility\FacilityApprove;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Count the total number of facilities
        $totalFacilities = Room::count();

        // $totalEquipmentStocks = DB::table('equipment_stocks')->count();
        $totalEquipmentStocks = EquipmentStock::count();

        $totalSuppliesStocks = SuppliesStock::count();

        $totalEventsActivities = Events::count();

        $totalMainteFacilityApprove = FacilityApprove::count();

        // Pass the totalFacilities variable to the Blade view
        return view('adminPages.admin_dashboard', compact('totalFacilities', 'totalEquipmentStocks', 'totalSuppliesStocks', 
        'totalEventsActivities', 'totalMainteFacilityApprove'));
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

    public function getSuppliesPerMonth(Request $request)
    {
        $suppliesPerMonth = Supplies::selectRaw('COUNT(*) as count, EXTRACT(MONTH FROM "SuppliesDate") as month')
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get();

        $Suppliesmonths = [];
        $Suppliescounts = [];

        foreach ($suppliesPerMonth as $data) {
            $Suppliesmonths[] = Carbon::create()->month((int) $data->month)->format('M'); // Month name
            $Suppliescounts[] = $data->count; 
        }

        // Return JSON response
        return response()->json([
            'Suppliesmonths' => $Suppliesmonths,
            'Suppliescounts' => $Suppliescounts,
        ]);
    }
}
