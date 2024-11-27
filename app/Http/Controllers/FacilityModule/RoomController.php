<?php

namespace App\Http\Controllers\FacilityModule;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FacilityModule\Facility;
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
                'currentEnrollment' => 0,
            ];
        })->keyBy('roomId')->toArray();

        // Merge API sections into the instructional rooms
        foreach ($foundSections as $section) {
            if (isset($section['roomId']) && $section['roomId'] !== null) {
                $combinedRooms[$section['roomId']] = array_merge($combinedRooms[$section['roomId']] ?? [], [
                    'session' => $section['session'] ?? null,
                    'gradeLevel' => $section['gradeLevel'] ?? null,
                    'sectionName' => $section['sectionName'] ?? null,
                    'currentEnrollment' => $section['currentEnrollment'] ?? 0,
                ]);
            }
        }

        return view('adminPages.admin_facilityRegRoom', [
            'combinedRooms' => $combinedRooms
        ]);
    }


    public function labindex()
    {
        // Fetch the API response
        $response = Http::get('https://bhnhs-sis-api-v1.onrender.com/api/v1/sis/section/rooms');
        $foundSections = $response->json()['foundSections'] ?? [];  // Default to an empty array if not found

        // Fetch the rooms from your own database
        $laboratoryRooms = Room::where('facilityRoomType', 'Laboratory')->get();

        // Map instructionalRooms by id for easy lookup
        $laboratoryRoomsMapped = $laboratoryRooms->keyBy('id');

        // Start with all instructional rooms
        $combinedRooms = $laboratoryRooms->map(function($room) {
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
                'currentEnrollment' => 0,
            ];
        })->keyBy('roomId')->toArray();

        // Merge API sections into the instructional rooms
        foreach ($foundSections as $section) {
            if (isset($section['roomId']) && $section['roomId'] !== null) {
                $combinedRooms[$section['roomId']] = array_merge($combinedRooms[$section['roomId']] ?? [], [
                    'session' => $section['session'] ?? null,
                    'gradeLevel' => $section['gradeLevel'] ?? null,
                    'sectionName' => $section['sectionName'] ?? null,
                    'currentEnrollment' => $section['currentEnrollment'] ?? 0,
                ]);
            }
        }

        return view('adminPages.admin_facilitySpecRoom', [
            'combinedRooms' => $combinedRooms
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'buildingName' => 'required|string|max:255',
            'room' => 'required|integer',
            'capacity' => 'required|integer',
            'facilityRoomDate' => 'required|date_format:m/d/Y',
        ]);

        // Convert the 'facilityRoomDate' to 'Y-m-d' format
        $facilityRoomDate = Carbon::createFromFormat('m/d/Y', $validatedData['facilityRoomDate'])->format('Y-m-d');


        // Create a new room entry
        $room = new Room();
        $room->BldName = $validatedData['buildingName'];
        $room->Room = $validatedData['room'];
        $room->facilityStatus = 'Available';
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
            ];
        });
    
        return response()->json([
            'foundSections' => $foundSections,
            'message' => 'Room added successfully!',
        ], 201);
    }

    public function showDetailsRooms()
    {
        // Fetch API response
        $apiResponse = Http::get('https://bhnhs-sis-api-v1.onrender.com/api/v1/sis/section/rooms');

        // Decode the API response
        $apiData = $apiResponse->json();

        // Your own data processing
        $combinedRooms = collect($apiData)->map(function ($room) {
            return [
                'facilityStatus' => $room['facilityStatus'],
                'BldName' => $room['BldName'],              
                'Room' => $room['Room'],                    
                'capacity' => $room['currentEnrollment'] . '/' . $room['Capacity'], 
                'session' => $room['session'],             
                'assigned' => $room['gradeLevel'] . ' - ' . $room['sectionName'], 
                // Add other fields if necessary
            ];
        });

        return view('adminPages.admin_facilityRegRoom', compact('combinedRooms'));
    }

    public function edit(Request $request)
    {
        $validated = $request-> validate([
            'buildingName' => 'required|string|max:255',
            'room' => 'required|integer',
            'capacity' => 'required|integer',
        ]);

        $room = Room::findorFail($request->input('id'));

        $room->BldName = $request->input('buildingName');
        $room->Room = $request->input('room');
        $room->Capacity = $request->input('capacity');

        $room->save();

        return response()->json(['message' => 'Room updated successfully.','room' => $room]);
    }

}
