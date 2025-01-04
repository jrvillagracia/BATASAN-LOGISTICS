<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipments\Equipment;
use App\Models\Models\FacilityModule\Room;


class DashboardController extends Controller
{
    public function index()
    {
        // Count the total number of facilities
        $totalFacilities = Room::count();

        $totalEquipment = Equipment::count();

        // Pass the totalFacilities variable to the Blade view
        return view('adminPages.admin_dashboard', compact('totalFacilities', 'totalEquipment'));
    }
}
