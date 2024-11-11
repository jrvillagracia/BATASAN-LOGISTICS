<?php

namespace App\Http\Controllers\FacilityModule;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Models\FacilityModule\Room;
use Carbon\Carbon;

class RoomController extends Controller
{
    public function room(Request $request)
    {
        $room = Room::all();
        return response()->json(['room' => $room]);
    }

    public function index()
    {
        // Fetch rooms of type 'Regular', now referred to as Instructional
        $instructionalRooms = Room::where('facilityRoomType', 'Instructional')->get();
        return view('admin_facilityRegRoom', [
            'instructionalRooms' => $instructionalRooms, // Changed variable name
        ]);
    }

    public function specialIndex()
    {
        // Retrieve Laboratory rooms (previously 'Special')
        $laboratoryRooms = Room::where('facilityRoomType', 'Special')->get();
        
        // Retrieve Instructional rooms (previously 'Regular')
        $instructionalRooms = Room::where('facilityRoomType', 'Regular')->get();

        // Check if there are any Laboratory rooms
        if ($laboratoryRooms->isNotEmpty()) {
            return view('admin_facilitySpecRoom', [
                'laboratoryRooms' => $laboratoryRooms, // Changed variable name
            ]);
        }

        // Check if there are any Instructional rooms
        if ($instructionalRooms->isNotEmpty()) {
            return view('admin_facilityRegRoom', [
                'instructionalRooms' => $instructionalRooms, // Changed variable name
            ]);
        }

        // Default view if no matching room types are found
        return view('admin_facilitySpecRoom', [
            'laboratoryRooms' => $laboratoryRooms, // Changed variable name
        ]);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'buildingName' => 'required|string|max:255',
            'room' => 'required|integer',
            'status' => 'required|string',
            'capacity' => 'required|integer',
            'facilityRoomDate' => 'required|string',
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

        // Save the room entry to the database
        $room->save();

        // Redirect back with a success message
        return response()->json([
            'id' => $room->id,
            'buildingName' => $room->BldName,
            'room' => $room->Room,
            'status' => $room->facilityStatus,
            'capacity' => $room->Capacity,
            'facilityRoomDate' => $room->facilityRoomDate,
            'facilityRoomType' => $room->facilityRoomType,  // Return the room type
            'message' => 'Room added successfully!',
        ], 201);

    }
}
