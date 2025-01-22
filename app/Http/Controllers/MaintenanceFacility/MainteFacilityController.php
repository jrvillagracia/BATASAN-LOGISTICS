<?php

namespace App\Http\Controllers\MaintenanceFacility;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\MaintenanceFacility\MainteFacility;
use App\Models\MaintenanceFacility\FacilityApprove;
use App\Models\MaintenanceFacility\FacilityComplete;

class MainteFacilityController extends Controller
{
    public function index()
    {
        $facility = MainteFacility::all();
        return view('adminPages.admin_mainteFacility', compact('facility'));
    }

    public function create()
    {
        return view('adminPages.admin_mainteFacility_create');
    }

    public function store(Request $request)
    {
        // Validate incoming request data
        $validator = Validator::make($request->all(), [
            'FacilityBuildingName' => 'required|string|max:255',
            'FacilityRoom' => 'required|string|max:255',
            'FacilityType' => 'required|string|max:255',
            'MainteFacilityReqUnit' => 'required|string|max:255',
            'MainteFacilityReqFOR' => 'required|string|max:255',
            'MainteFacilityTime' => 'required|date_format:H:i',
            'MainteFacilityDate' => 'required|date_format:Y-m-d',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        // Generate a temporary RepairId based on the current timestamp
        $tempRepairId = 'TEMP-' . time();

        // Save the facility with the temporary RepairId first
        $facility = MainteFacility::create([
            'FacilityBuildingName' => $request->FacilityBuildingName,
            'FacilityRoom' => $request->FacilityRoom,
            'FacilityType' => $request->FacilityType,
            'MainteFacilityReqUnit' => $request->MainteFacilityReqUnit,
            'MainteFacilityReqFOR' => $request->MainteFacilityReqFOR,
            'MainteFacilityTime' => $request->MainteFacilityTime,
            'MainteFacilityDate' => $request->MainteFacilityDate,
            'RepairId' => $tempRepairId,
        ]);

        // Now generate the custom RepairId based on the auto-incremented 'mainteFacilityId'
        $newRepairId = 'RPR-' . str_pad($facility->mainteFacilityId, 4, '0', STR_PAD_LEFT); // e.g., RPR-0001, RPR-0002, etc.

        // Update the facility with the generated RepairId
        $facility->update([
            'RepairId' => $newRepairId
        ]);

        // Return success response
        return response()->json([
            'status' => 'success',
            'message' => 'Facility request created successfully.',
            'data' => $facility
        ]);
    }


    public function showDetails(Request $request)
    {
 
        $mainteFacilityId = $request->input('MainteFacilityId');

        $facility = MainteFacility::where('MainteFacilityId', $mainteFacilityId)->first();

        if (!$facility) {
            return response()->json(['message' => 'Facility not found'], 404);
        }

        return response()->json($facility);
    }

    public function approve(Request $request)
    {
        if (!$request->has('mainteFacilityId')) {
            return response()->json(['message' => 'Maintenance Facility ID is required'], 400);
        }

        $facility = MainteFacility::find($request->mainteFacilityId);

        if ($facility) {
            FacilityApprove::create([
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

            $facility->delete();

            return response()->json(['message' => 'Facility request approved successfully.']);
        } else {
            return response()->json(['message' => 'Facility not found'], 404);
        }
    }

    public function decline(Request $request)
    {
        // Validate if the request contains 'mainteFacilityId'
        if (!$request->has('mainteFacilityId')) {
            \Log::error('Decline failed: Missing mainteFacilityId in request.');
            return response()->json(['message' => 'mainteFacilityId is required'], 400);
        }

        // Log the received ID for debugging
        \Log::info('Decline request received for mainteFacilityId: ' . $request->mainteFacilityId);

        // Find the facility by its mainteFacilityId
        $facility = MainteFacility::find($request->mainteFacilityId);

        if ($facility) {
            \Log::info('Facility found: ' . $facility->mainteFacilityId);

            // Move facility details to the FacilityComplete table
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

            \Log::info('FacilityComplete record created for mainteFacilityId: ' . $facility->mainteFacilityId);

            // Delete the facility record from the mainte_facility table
            $facility->delete();

            \Log::info('Facility with mainteFacilityId: ' . $facility->mainteFacilityId . ' deleted from MainteFacility table.');

            // Return a successful response
            return response()->json(['message' => 'Facility request declined successfully.']);
        } else {
            \Log::warning('Facility not found for mainteFacilityId: ' . $request->mainteFacilityId);
            return response()->json(['message' => 'Facility not found'], 404);
        }
    }
}
