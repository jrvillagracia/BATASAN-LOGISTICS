<?php

namespace App\Http\Controllers\MaintenanceFacility;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MaintenanceFacility\FacilityApprove;

class FacilityApproveController extends Controller
{
    public function index()
    {
        $facility = FacilityApprove::all();

        return view('adminPages.admin_mainteForRepFacility', compact('facility'));
    }
}
