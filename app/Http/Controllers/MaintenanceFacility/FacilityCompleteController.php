<?php

namespace App\Http\Controllers\MaintenanceFacility;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MaintenanceFacility\MaintenanceFacility;
use App\Models\MaintenanceFacility\FacilityComplete;

class FacilityCompleteController extends Controller
{
    public function index()
    {
        $facility = FacilityComplete::all();

        return view('adminPages.admin_ComReqMainteFacility', compact ('facility'));
    }

    public function create()
    {
        return view('adminPages.admin_ComReqMainteFacility_create');
    }
}
