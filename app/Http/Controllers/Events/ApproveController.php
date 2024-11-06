<?php

namespace App\Http\Controllers\Events;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Events\Events;
use App\Models\Events\ApprovedReq;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ApproveController extends Controller
{
    public function index() {
        // Retrieve all events
        $events = ApprovedReq::all();
        
        // Retrieve supplies and equipment data
        $supplies = DB::table('supplies')->select([
            'SuppliesName as ProductName',
            'SuppliesBrandName as BrandName',
            'SuppliesCategory as Type',
            'SuppliesQuantity as Quantity',
            'SuppliesSKU as SKU',
            'id'
        ])->get();
    
        $equipment = DB::table('equipment')->select([
            'EquipmentName as ProductName',
            'EquipmentBrandName as BrandName',
            'EquipmentCategory as Type',
            'EquipmentQuantity as Quantity',
            'EquipmentSKU as SKU',
            'id'
        ])->get();
    
        // Merge supplies and equipment data into a single collection
        $mergedItems = $supplies->merge($equipment);
    
        // Pass both events and mergedItems to the view
        return view('adminPages.admin_eventsAprRequest', compact('events', 'mergedItems'));
    }
    
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'EventApprTime' => 'required|string',
            'EventApprDate' => 'required|date',
            'EventApprRequestOffice' => 'required|string',
            'EventApprRequestFor' => 'required|string',
            'EventApprName' => 'required|string',
            'StartEventApprDate' => 'required|date',
            'EndEventApprDate' => 'required|date',
            'StartEventApprTime' => 'required|string',
            'EndEventApprTime' => 'required|string',
            'EventApprLocation' => 'required|string',
            'EventApprProductName' => 'required|string',
            'EventApprQuantity' => 'required|integer',
        ]);

        // Generate a new eventId
        $eventId = $this->generateEventId();

        // Insert the validated data into the approved_req table
        ApprovedReq::create([
            'EventApprTime' => $validatedData['EventApprTime'],
            'EventApprDate' => $validatedData['EventApprDate'],
            'EventApprRequestOffice' => $validatedData['EventApprRequestOffice'],
            'EventApprRequestFor' => $validatedData['EventApprRequestFor'],
            'EventApprName' => $validatedData['EventApprName'],
            'StartEventApprDate' => $validatedData['StartEventApprDate'],
            'EndEventApprDate' => $validatedData['EndEventApprDate'],
            'StartEventApprTime' => $validatedData['StartEventApprTime'],
            'EndEventApprTime' => $validatedData['EndEventApprTime'],
            'EventApprLocation' => $validatedData['EventApprLocation'],
            'EventApprProductName' => $validatedData['EventApprProductName'],
            'EventApprQuantity' => $validatedData['EventApprQuantity'],
            'eventId' => $eventId,
            'status' => 'Approved',
        ]);

        return response()->json(['message' => 'Event successfully submitted and stored!']);
    }

    private function generateEventId()
    {
        $lastId = ApprovedReq::orderBy('id', 'desc')->first();
        if ($lastId) {
            // Extract the numeric part of the last eventId
            $lastIdNumber = (int) substr($lastId->eventId, 3); // Assumes eventId is in the format EA-0000
            $newIdNumber = $lastIdNumber + 1;
        } else {
            $newIdNumber = 1;
        }

        return 'EA-' . str_pad($newIdNumber, 4, '0', STR_PAD_LEFT); // Generate EA-0001, EA-0002, ...
    }

    public function mergedItems($eventId)
    {
        // Fetch the event details
        $event = ApprovedReq::find($eventId);

        if (!$event) {
            return response()->json(['error' => 'Event not found'], 404);
        }

        // Retrieve supplies data
        $supplies = DB::table('supplies')->select([
            'SuppliesName as ProductName',
            'SuppliesBrandName as BrandName',
            'SuppliesCategory as Type',
            'SuppliesQuantity as Quantity',
            'SuppliesSKU as SKU',
        ])->get();

        // Retrieve equipment data
        $equipment = DB::table('equipment')->select([
            'EquipmentName as ProductName',
            'EquipmentBrandName as BrandName',
            'EquipmentCategory as Type',
            'EquipmentQuantity as Quantity',
            'EquipmentSKU as SKU',
        ])->get();

        // Merge supplies and equipment data into a single collection
        $mergedItems = $supplies->merge($equipment);

        // Return event details and merged items as JSON
        return response()->json([
            'event' => $event,
            'mergedItems' => $mergedItems
        ]);
    }

    public function getEventDetails(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'id' => 'required|integer|exists:approved_req,id', 
        ]);

        // Get the event ID from the validated data
        $id = $validated['id'];

        // Fetch all details of the event
        $eventDetails = ApprovedReq::select(
            'id',
            'EventApprDate', 
            'EventApprTime', 
            'EventApprRequestOffice', 
            'EventApprName', 
            'StartEventApprDate', 
            'StartEventApprTime', 
            'EventApprLocation', 
            'EventApprProductName', 
            'EventApprQuantity'
        )
        ->where('id', $id) // Ensure this matches the primary key of your events table
        ->first();

        // Check if event details were found
        if (!$eventDetails) {
            return response()->json(['message' => 'Event not found'], 404);
        }

        // Return the event details
        return response()->json(['eventDetails' => $eventDetails], 200);
    }
}
