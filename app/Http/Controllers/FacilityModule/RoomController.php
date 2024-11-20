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
        // Fetch data from the external API
    $response = Http::get('https://batasan-logistics.onrender.com/admin_dashboard');
    $foundSections = $response->json()['foundSections'] ?? [];  // Get 'foundSections' from the response

    // Fetch the rooms from your own database
    $instructionalRooms = Room::where('facilityRoomType', 'Instructional')->get();

    // Map instructionalRooms by id for easy lookup
    $instructionalRoomsMapped = $instructionalRooms->keyBy('id');

    // Merge the fetched sections with instructional rooms
    $combinedRooms = array_map(function($section) use ($instructionalRoomsMapped) {
        // Check if a roomId exists in instructionalRooms to match with foundSections
        if (isset($section['roomId']) && $section['roomId'] !== null) {
            $instructionalRoom = $instructionalRoomsMapped->get($section['roomId']);
            if ($instructionalRoom) {
                // Merge the instructional room data with the found section
                $section = array_merge($section, [
                    'facilityRoom' => [
                        'BldName' => $instructionalRoom->BldName,
                        'Room' => $instructionalRoom->Room,
                        'facilityStatus' => $instructionalRoom->facilityStatus,
                        'Capacity' => $instructionalRoom->Capacity,
                        'facilityRoomType' => $instructionalRoom->facilityRoomType,
                    ]
                ]);
            }
        }
        return $section;
    }, $foundSections);

    // foreach($combinedRooms as $room){

    // }
    // dd($combinedRooms);

        // return response()->json([
        //     'rooms' => $combinedRooms,
        //     'message' => 'Combined rooms fetched successfully!',
        // ], 200);

        return view('adminPages.admin_facilityRegRoom', [
            'combinedRooms' => $combinedRooms
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
            return view('adminPages.admin_facilitySpecRoom', [
                'laboratoryRooms' => $laboratoryRooms, // Changed variable name
            ]);
        }

        // Check if there are any Instructional rooms
        if ($instructionalRooms->isNotEmpty()) {
            return view('adminPages.admin_facilityRegRoom', [
                'instructionalRooms' => $instructionalRooms, // Changed variable name
            ]);
        }

        // Default view if no matching room types are found
        return view('adminPages.admin_facilitySpecRoom', [
            'laboratoryRooms' => $laboratoryRooms, // Changed variable name
        ]);
    }

    public function store(Request $request)
    {
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
