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
        \Log::debug('Rooms:', $room);
        return response()->json(['room' => $room]);
    }

    public function index()
    {
        // Fetch the API response
        $response = Http::get('https://bhnhs-sis-api-v1.onrender.com/api/v1/sis/section/rooms');
        $foundSections = $response->json()['foundSections'] ?? [];  // Default to an empty array if not found

        // Fetch the rooms from your own database
        $instructionalRooms = Room::where('facilityRoomType', 'Instructional')->get();

        // Map instructionalRooms by id for easy lookup
        $instructionalRoomsMapped = $instructionalRooms->keyBy('id');

        // Start with all instructional rooms
        $combinedRooms = $instructionalRooms->map(function($room) {
            return [
                'roomId' => $room->id,
                'facilityRoom' => [
                    'BldName' => $room->BldName,
                    'Room' => $room->Room,
                    'facilityStatus' => $room->facilityStatus,
                    'Capacity' => $room->Capacity,
                    'facilityRoomType' => $room->facilityRoomType,
                ],
                'session' => null,       // Default values for missing API data
                'gradeLevel' => null,
                'sectionName' => null,
            ];
        })->keyBy('roomId')->toArray();

        // Merge API sections into the instructional rooms
        foreach ($foundSections as $section) {
            if (isset($section['roomId']) && $section['roomId'] !== null) {
                $combinedRooms[$section['roomId']] = array_merge($combinedRooms[$section['roomId']] ?? [], [
                    'session' => $section['session'] ?? null,
                    'gradeLevel' => $section['gradeLevel'] ?? null,
                    'sectionName' => $section['sectionName'] ?? null,
                ]);
            }
        }

        return view('adminPages.admin_facilityRegRoom', [
            'combinedRooms' => $combinedRooms
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
