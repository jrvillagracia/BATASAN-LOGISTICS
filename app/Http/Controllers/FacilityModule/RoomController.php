<?php

namespace App\Http\Controllers\FacilityModule;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Models\FacilityModule\Room;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;


class RoomController extends Controller
{
    public function room(Request $request)
    {
        $room = Room::all();
        return response()->json(['room' => $room]);
    }

    public function index()
    {
            // Fetch the rooms from your own database
            $instructionalRooms = Room::where('facilityRoomType', 'Instructional')->get();
        
            // Return the view with the rooms data
            return view('adminPages.admin_facilityRegRoom', [
                'rooms' => $instructionalRooms
            ]);
    }

    public function specialIndex()
    {
        // Retrieve Laboratory rooms (previously 'Special')
        $laboratoryRooms = Room::where('facilityRoomType', 'Special')->get();

        // Check if there are any Laboratory rooms
        if ($laboratoryRooms->isNotEmpty()) {
            return view('adminPages.admin_facilitySpecRoom', [
                'laboratoryRooms' => $laboratoryRooms,
            ]);
        }

        // Check if there are any Instructional rooms
        if ($instructionalRooms->isNotEmpty()) {
            return view('adminPages.admin_facilityRegRoom', [
                'instructionalRooms' => $instructionalRooms, 
            ]);
        }

        // Default view if no matching room types are found
        return view('adminPages.admin_facilitySpecRoom', [
            'laboratoryRooms' => $laboratoryRooms,
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'buildingName' => 'required|string|max:255',
            'room' => 'required|integer',
            'status' => 'required|string',
            'capacity' => 'required|integer',
            'facilityRoomDate' => 'required|date_format:m/d/Y',
        ]);

        // Convert the 'facilityRoomDate' to 'Y-m-d' format
        $facilityRoomDate = Carbon::createFromFormat('m/d/Y', $validatedData['facilityRoomDate'])->format('Y-m-d');


        // Create a new room entry
        $room = new Room();
        $room->BldName = $validatedData['buildingName'];
        $room->Room = $validatedData['room'];
        $room->facilityStatus = $validatedData['status'];
        $room->Capacity = $validatedData['capacity'];
        $room->facilityRoomDate = $facilityRoomDate;  // Use the formatted date
        $room->facilityRoomType = $request->facilityRoomType;  // Add the facility room type
        $room->save();

        $foundSections = Room::all()->map(function($room) {
            return [
                'id' => $room->id,
                'buildingName' => $room->BldName,
                'room' => $room->Room,
                'facilityStatus' => $room->facilityStatus,
                'capacity' => $room->Capacity,
                'facilityRoomDate' => $room->facilityRoomDate,
                'facilityRoomType' => $room->facilityRoomType,
                // Include additional fields if needed
            ];
        });
    
        return response()->json([
            'foundSections' => $foundSections,
            'message' => 'Room added successfully!',
        ], 201);
    }
}
