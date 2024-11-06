<?php

namespace App\Http\Controllers\Events;

use App\Http\Controllers\Controller;
use App\Models\Events\Events;
use App\Models\Events\ApprovedReq;
use App\Models\Events\CompleteReq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;


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
            'EventApprLocation' => 'required|string|max:255',
            'EventApprProductName' => 'required|string|max:255',
            'EventApprQuantity' => 'required|integer',
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
            'EventApprLocation' => $request->EventApprLocation,
            'EventApprProductName' => $request->EventApprProductName,
            'EventApprQuantity' => $request->EventApprQuantity,
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
            'EventApprLocation', 
            'EventApprProductName', 
            'EventApprQuantity'
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

}
