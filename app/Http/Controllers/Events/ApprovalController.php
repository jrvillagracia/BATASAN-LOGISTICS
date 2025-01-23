<?php

namespace App\Http\Controllers\Events;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Events\Events;
use App\Models\Supplies\Supplies;
use App\Models\Events\ApprovedReq;
use App\Models\Events\CompleteReq;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Equipments\Equipment;
use Illuminate\Support\Facades\Validator;


class ApprovalController extends Controller
{
    public function index()
    {
        $events = Events::all()->map(function ($event) {
            $event->status = $event->status ?? 'Pending'; 
            return $event;
        });

        return view('adminPages.admin_eventsForApproval', compact('events'));
    }

    public function create()
    {
        return view('adminPages.admin_eventsForApproval'); 

    }

    public function store(Request $request)
    {
        // Validate incoming request data
        $validator = Validator::make($request->all(), [
            'EventApprTime' => 'required|date_format:H:i',
            'EventApprDate' => 'required|date_format:m/d/Y',
            'EventApprRequestOffice' => 'required|string|max:255',
            'EventApprRequestFor' => 'required|string|max:255',
            'EventApprName' => 'required|string|max:255',
            'StartEventApprDate' => 'required|date_format:m/d/Y',
            'EndEventApprDate' => 'required|date_format:m/d/Y',
            'StartEventApprTime' => 'required|date_format:H:i',
            'EndEventApprTime' => 'required|date_format:H:i',
            'EventsActBldName' => 'required|string|max:255',
            'EventsActRoom' => 'required|string|max:255',
            'EventsActivityInventory' => 'required|string|max:255',
            'EventActCategoryName' => 'required|string|max:255',
            'EventActType' => 'required|string|max:255',
            'EventActUnit' => 'required|string|max:255',
            'EventActQuantity' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        // Process and format the dates
        try {
            $eventApprDate = Carbon::createFromFormat('m/d/Y', $request->EventApprDate)->format('Y-m-d');
            $startEventApprDate = Carbon::createFromFormat('m/d/Y', $request->StartEventApprDate)->format('Y-m-d');
            $endEventApprDate = Carbon::createFromFormat('m/d/Y', $request->EndEventApprDate)->format('Y-m-d');
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Invalid date format'], 422);
        }

        // First, create the event without the custom eventId
        $event = Events::create([
            'EventApprTime' => $request->EventApprTime,
            'EventApprDate' => $eventApprDate,
            'EventApprRequestOffice' => $request->EventApprRequestOffice,
            'EventApprRequestFor' => $request->EventApprRequestFor,
            'EventApprName' => $request->EventApprName,
            'StartEventApprDate' => $startEventApprDate,
            'EndEventApprDate' => $endEventApprDate,
            'StartEventApprTime' => $request->StartEventApprTime,
            'EndEventApprTime' => $request->EndEventApprTime,
            'EventsActBldName' => $request->EventsActBldName,
            'EventsActRoom' => $request->EventsActRoom,
            'EventsActivityInventory' => $request->EventsActivityInventory,
            'EventActCategoryName' => $request->EventActCategoryName,
            'EventActType' => $request->EventActType,
            'EventActUnit' => $request->EventActUnit,
            'EventActQuantity' => $request->EventActQuantity,
        ]);

        // Now generate the custom eventId based on the auto-incremented 'id'
        $newId = 'EA-' . str_pad($event->id, 4, '0', STR_PAD_LEFT); // e.g., EA-0001, EA-0002, etc.

        // Update the event with the generated eventId
        $event->update([
            'eventId' => $newId
        ]);

        // Return success response
        return response()->json([
            'status' => 'success',
            'message' => 'Event created successfully.',
            'event' => $event,
            'status' => 'Pending' // Include the status in the response
        ]);
    }


    public function getEventDetails(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'id' => 'required|integer|exists:events,id', 
        ]);

        // Get the event ID from the validated data
        $id = $validated['id'];

        // Fetch all details of the event
        $eventDetails = Events::select(
            'id',
            'EventApprDate', 
            'EventApprTime', 
            'EventApprRequestOffice', 
            'EventApprName', 
            'StartEventApprDate', 
            'StartEventApprTime', 
            'EventsActBldName',
            'EventsActRoom',
            'EventsActivityInventory',
            'EventActCategoryName',
            'EventActType',
            'EventActUnit', 
            'EventActQuantity'
        )
        ->where('id', $id)
        ->first();

        // Check if event details were found
        if (!$eventDetails) {
            return response()->json(['message' => 'Event not found'], 404);
        }

        // Return the event details
        return response()->json(['eventDetails' => $eventDetails], 200);
    }

    public function approve(Request $request)
    {
        // Check if the request contains an ID
        if (!$request->has('id')) {
            return response()->json(['message' => 'Event ID is required'], 400);
        }

        // Find the event by its ID
        $event = Events::find($request->id);

        if ($event) {
            // Insert the event details into the 'approved_req' table using the same 'eventId'
            ApprovedReq::create([
                'eventId' => $event->eventId,
                'EventApprTime' => $event->EventApprTime,
                'EventApprDate' => $event->EventApprDate,
                'EventApprRequestOffice' => $event->EventApprRequestOffice,
                'EventApprRequestFor' => $event->EventApprRequestFor,
                'EventApprName' => $event->EventApprName,
                'StartEventApprDate' => $event->StartEventApprDate,
                'EndEventApprDate' => $event->EndEventApprDate,
                'StartEventApprTime' => $event->StartEventApprTime,
                'EndEventApprTime' => $event->EndEventApprTime,
                'EventApprLocation' => $event->EventApprLocation,
                'EventApprProductName' => $event->EventApprProductName,
                'EventApprQuantity' => $event->EventApprQuantity,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Optionally, delete the event from the original table (Events) if required
            $event->delete();

            return response()->json(['message' => 'Event approved successfully!']);
        } else {
            return response()->json(['message' => 'Event not found'], 404);
        }
    }

    public function decline(Request $request)
    {
        // Check if the request contains an ID
        if (!$request->has('id')) {
            return response()->json(['message' => 'Event ID is required'], 400);
        }

        // Find the event by its ID
        $event = Events::find($request->id);

        if ($event) {
            // Insert the event details into the 'complete_req' table using the same 'eventId'
            CompleteReq::create([
                'eventId' => $event->eventId,
                'EventApprTime' => $event->EventApprTime,
                'EventApprDate' => $event->EventApprDate,
                'EventApprRequestOffice' => $event->EventApprRequestOffice,
                'EventApprRequestFor' => $event->EventApprRequestFor,
                'EventApprName' => $event->EventApprName,
                'StartEventApprDate' => $event->StartEventApprDate,
                'EndEventApprDate' => $event->EndEventApprDate,
                'StartEventApprTime' => $event->StartEventApprTime,
                'EndEventApprTime' => $event->EndEventApprTime,
                'EventApprLocation' => $event->EventApprLocation,
                'EventApprProductName' => $event->EventApprProductName,
                'EventApprQuantity' => $event->EventApprQuantity,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Optionally, delete the event from the original table (Events) if required
            $event->delete();

            return response()->json(['message' => 'Event declined and moved to complete requests successfully!']);
        } else {
            return response()->json(['message' => 'Event not found'], 404);
        }
    }

    public function getItemTypes()
    {
        $supplies = DB::table('supplies')
            ->select('SuppliesSKU as id', 'SuppliesName as name', DB::raw("'Supplies' as type"))
            ->get();

        $equipment = DB::table('equipment')
            ->select('EquipmentSKU as id', 'EquipmentName as name', DB::raw("'Equipment' as type"))
            ->get();

        // Merge the results
        $items = $supplies->merge($equipment);

        return response()->json($items);
    }

    public function getAllEquipmentAndSupplies()
    {
        // Fetch all equipment and supplies
        $equipment = Equipment::all();
        $supplies = Supplies::all();

        // Return both collections as separate data in the response
        return response()->json([
            'equipment' => $equipment,
            'supplies' => $supplies,
        ]);
    }
    
}
