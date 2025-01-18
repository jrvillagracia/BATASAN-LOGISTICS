<?php

namespace App\Http\Controllers\MaintenanceFacility;

use App\Http\Controllers\Controller;
use App\Models\MaintenanceFacility\MainteFacility;
use Illuminate\Http\Request;

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
        // Validate the incoming data
        $validatedData = $request->validate([
            'FacilityBuildingName' => 'required|string|max:255',
            'FacilityRoom' => 'required|string|max:255',
            'FacilityType' => 'required|string|max:255',
            'MainteFacilityReqUnit' => 'required|string|max:255',
            'MainteFacilityReqFOR' => 'required|string|max:255',
            'MainteFacilityTime' => 'required|date_format:H:i',
            'MainteFacilityDate' => 'required|date_format:Y-m-d',
        ]);

        // Generate the RepairId
        $lastFacility = MainteFacility::orderBy('mainteFacilityId', 'desc')->first();
        $lastRepairId = $lastFacility ? $lastFacility->RepairId : null;

        if ($lastRepairId) {
            $lastNumber = (int) substr($lastRepairId, 3); // Extract the numeric part
            $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT); // Increment and pad
        } else {
            $newNumber = '001'; // Default for the first entry
        }

        $newRepairId = 'RPR' . $newNumber;
        $validatedData['RepairId'] = $newRepairId;

        // Save the data to the database
        MainteFacility::create($validatedData);

        // Return a JSON response
        return response()->json([
            'success' => true,
            'message' => 'Facility request created successfully.',
            'data' => $validatedData
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

    public function decline(Request $request)
    {
        // Validate the request input
        $validated = $request->validate([
            'mainteFacilityId' => 'required|integer|exists:mainte_facility,mainteFacilityId',
        ]);

        try {
            $mainteFacilityId = $validated['mainteFacilityId'];

            // Find and delete the facility
            $facility = MainteFacility::findOrFail($mainteFacilityId);
            $facility->delete();

            return response()->json([
                'success' => true,
                'message' => 'Facility request declined and removed successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to process the request. Please try again.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

}
