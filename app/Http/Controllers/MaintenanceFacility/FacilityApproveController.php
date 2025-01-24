<?php

namespace App\Http\Controllers\MaintenanceFacility;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MaintenanceFacility\MainteFacility;
use App\Models\MaintenanceFacility\FacilityApprove;
use App\Models\MaintenanceFacility\FacilityComplete;

class FacilityApproveController extends Controller
{
    public function index()
    {
        $facility = FacilityApprove::whereNotIn('mainteFacilityId', function ($query) {
            $query->select('mainteFacilityId')->from('facility_complete');
        })->get();
    
        return view('adminPages.admin_mainteForRepFacility', compact('facility'));
    }

    public function complete(Request $request)
    {
        if (!$request->has('facilityApproveId')) {
            return response()->json(['message' => 'Maintenance Facility ID is required'], 400);
        }

        $facility = FacilityApprove::find($request->facilityApproveId);

        if ($facility) {
            FacilityComplete::create([
                'mainteFacilityId' => $facility->mainteFacilityId,
                'MainteFacilityDate' => $facility->MainteFacilityDate,
                'MainteFacilityTime' => $facility->MainteFacilityTime,
                'RepairId' => $facility->RepairId,
                'FacilityBuildingName' => $facility->FacilityBuildingName,
                'FacilityRoom' => $facility->FacilityRoom,
                'FacilityType' => $facility->FacilityType,
                'MainteFacilityReqUnit' => $facility->MainteFacilityReqUnit,
                'MainteFacilityReqFOR' => $facility->MainteFacilityReqFOR,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return response()->json(['message' => 'Facility request approved successfully.']);
        } else {
            return response()->json(['message' => 'Facility not found'], 404);
        }
    }


    public function cancel(Request $request)
    {
        // Validate if the request contains 'facilityApproveId'
        if (!$request->has('facilityApproveId')) {
            return response()->json(['message' => 'facilityApproveId is required'], 400);
        }

        // Find the facility by its mainteFacilityId
        $facility = FacilityApprove::find($request->facilityApproveId);

        if ($facility) {
            \Log::info('Facility found: ' . $facility->facilityApproveId);

            FacilityComplete::create([
                'mainteFacilityId' => $facility->mainteFacilityId,
                'MainteFacilityDate' => $facility->MainteFacilityDate,
                'MainteFacilityTime' => $facility->MainteFacilityTime,
                'RepairId' => $facility->RepairId,
                'FacilityBuildingName' => $facility->FacilityBuildingName,
                'FacilityRoom' => $facility->FacilityRoom,
                'FacilityType' => $facility->FacilityType,
                'MainteFacilityReqUnit' => $facility->MainteFacilityReqUnit,
                'MainteFacilityReqFOR' => $facility->MainteFacilityReqFOR,
                'created_at' => now(),
                'updated_at' => now(),
            ]);


            // Return a successful response
            return response()->json(['message' => 'Facility request declined successfully.']);
        } else {
            \Log::warning('Facility not found for mainteFacilityId: ' . $request->facilityApproveId);
            return response()->json(['message' => 'Facility not found'], 404);
        }
    }
}
