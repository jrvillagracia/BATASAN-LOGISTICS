<?php

namespace App\Http\Controllers\FacilityModule;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Models\FacilityModule\Room;

class RoomController extends Controller
{
    public function room (Request $request)
    {
        $room = Room::all();

        return response()->json(['room'=> $room]);
    }

    public function index()
    {
        $regularRooms = Room::where('facilityRoomType', 'Regular')->get();
        return view('admin_facilityRegRoom', [
            'regularRooms' => $regularRooms,
        ]);
    }

    public function specialIndex()
    {
        $specialRooms = Room::where('facilityRoomType', 'Special')->get();
        return view('admin_facilitySpecRoom', [
            'specialRooms' => $specialRooms,
        ]);
    }


    public function store (Request $request)
    {
        $validatedData = $request->validate([
            'buildingName' => 'required|string|max:255',
            'room' => 'required|integer',
            'shift' => 'required|string',
            'status' => 'required|string',
            'capacity' => 'required|integer',
            'facilityRoomType' => 'required|string',
        ]);

        // Create a new room entry
        $room = new Room();
        $room->BldName = $validatedData['buildingName'];
        $room->Room = $validatedData['room'];
        $room->facilityShift = $validatedData['shift'];
        $room->facilityStatus = $validatedData['status'];
        $room->Capacity = $validatedData['capacity'];
        $room->facilityRoomType = $validatedData['facilityRoomType'];
        
        // Save the room entry to the database
        $room->save();

        // Redirect back with a success message
        return response()->json([
            'id' => $room->id,
            'buildingName' => $room->BldName,
            'room' => $room->Room,
            'shift' => $room->facilityShift,
            'status' => $room->facilityStatus,
            'capacity' => $room->Capacity,
            'roomType' => $room->facilityRoomType, // Returning room type
            'message' => 'Room added successfully!',
        ], 201);

}
}