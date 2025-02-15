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
        return response()->json(['room' => $room]);
    }

    public function index()
    {
        // Fetch the API response
        $response = Http::get('https://bhnhs-sis-api-v1.onrender.com/api/v1/sis/section/rooms/schoolYear');
        $foundSections = $response->json()['foundSections'] ?? []; // Default to an empty array if not found

        // Fetch the rooms from your own database
        $instructionalRooms = Room::where('facilityRoomType', 'Instructional')->get();

        if ($instructionalRooms->isEmpty()) {
            // If no instructional rooms exist, return empty data structures
            return view('adminPages.admin_facilityRegRoom', [
                'combinedRooms' => [],
                'emptyRooms' => []
            ]);
        }

        $currentDate = Carbon::now()->format('m/d/Y');

        // Start with all instructional rooms
        $combinedRooms = $instructionalRooms->map(function ($room) use ($currentDate) {
            return [
                'roomId' => $room->id,
                'facilityRoom' => [
                    'BldName' => $room->BldName,
                    'Room' => $room->Room,
                    'facilityStatus' => $room->facilityStatus,
                    'Capacity' => $room->Capacity,
                    'facilityRoomType' => $room->facilityRoomType,
                    'schoolYear' => $room->schoolYear ?? 'unknown',
                ],
                'session' => null,       // Default values for missing API data
                'gradeLevel' => null,
                'sectionName' => null,
                'currentEnrollment' => 0,
                'assignedDate' => $currentDate
            ];
        })->keyBy('roomId')->toArray();

        // Empty rooms list
        $emptyRooms = $combinedRooms;

        // Merge API sections into the instructional rooms
        foreach ($foundSections as $section) {
            // Skip sections without a valid roomId
            if (!isset($section['roomId']) || $section['roomId'] === null) {
                continue;
            }

            $roomId = $section['roomId'];

            // Check if the roomId exists in the combinedRooms array
            if (isset($combinedRooms[$roomId])) {
                $combinedRooms[$roomId] = array_merge($combinedRooms[$roomId], [
                    'session' => $section['session'] ?? null,
                    'gradeLevel' => $section['gradeLevel'] ?? null,
                    'sectionName' => $section['sectionName'] ?? null,
                    'currentEnrollment' => $section['currentEnrollment'] ?? 0,
                    'assignedDate' => $currentDate
                ]);

                // Remove from emptyRooms since it's now populated
                unset($emptyRooms[$roomId]);
            }
        }

        // Check for rooms under maintenance
        $maintenanceRooms = \DB::table('mainte_facility')
            ->select('FacilityBuildingName', 'FacilityRoom')
            ->get()
            ->keyBy(function ($item) {
                return $item->FacilityBuildingName . '-' . $item->FacilityRoom;
            });

        foreach ($combinedRooms as &$room) {
            $key = $room['facilityRoom']['BldName'] . '-' . $room['facilityRoom']['Room'];
            if (isset($maintenanceRooms[$key])) {
                $room['facilityRoom']['facilityStatus'] = 'Under Maintenance';
            }
        }

        return view('adminPages.admin_facilityRegRoom', [
            'combinedRooms' => $combinedRooms, // Rooms with data
            'emptyRooms' => $emptyRooms         // Rooms without data
        ]);
    }

    public function labindex()
    {
        // Fetch the API response
        $response = Http::get('https://bhnhs-sis-api-v1.onrender.com/api/v1/sis/section/rooms/schoolYear');
        $foundSections = $response->json()['foundSections'] ?? []; // Default to an empty array if not found

        // Fetch laboratory rooms from your database
        $laboratoryRooms = Room::where('facilityRoomType', 'Laboratory')->get();

        // Handle empty laboratory rooms
        if ($laboratoryRooms->isEmpty()) {
            return view('adminPages.admin_facilitySpecRoom', [
                'populatedLaboratoryRooms' => [],
                'emptyLaboratoryRooms' => [],
            ]);
        }

        $currentDate = Carbon::now()->format('m/d/Y');

        // Function to map room data
        $mapRooms = function ($rooms) use ($currentDate) {
            return $rooms->map(function ($room) use ($currentDate) {
                return [
                    'roomId' => $room->id,
                    'facilityRoom' => [
                        'BldName' => $room->BldName,
                        'Room' => $room->Room,
                        'facilityStatus' => $room->facilityStatus,
                        'Capacity' => $room->Capacity,
                        'facilityRoomType' => $room->facilityRoomType,
                        'schoolYear' => $room->schoolYear ?? 'unknown',
                    ],
                    'session' => null,       // Default values for missing API data
                    'gradeLevel' => null,
                    'sectionName' => null,
                    'currentEnrollment' => 0,
                    'assignedDate' => $currentDate
                ];
            })->keyBy('roomId')->toArray();
        };

        // Map laboratory rooms
        $laboratoryCombined = $mapRooms($laboratoryRooms);

        // Initialize empty laboratory rooms
        $emptyLaboratoryRooms = $laboratoryCombined;

        // Merge API sections into laboratory rooms
        foreach ($foundSections as $section) {
            if (isset($section['roomId']) && $section['roomId'] !== null) {
                if (isset($laboratoryCombined[$section['roomId']])) {
                    $laboratoryCombined[$section['roomId']] = array_merge(
                        $laboratoryCombined[$section['roomId']] ?? [],
                        [
                            'session' => $section['session'] ?? null,
                            'gradeLevel' => $section['gradeLevel'] ?? null,
                            'sectionName' => $section['sectionName'] ?? null,
                            'currentEnrollment' => $section['currentEnrollment'] ?? 0,
                            'assignedDate' => $currentDate
                        ]
                    );
                    unset($emptyLaboratoryRooms[$section['roomId']]);
                }
            }
        }

        return view('adminPages.admin_facilitySpecRoom', [
            'populatedLaboratoryRooms' => $laboratoryCombined,       // Rooms with data
            'emptyLaboratoryRooms' => $emptyLaboratoryRooms          // Rooms without data
        ]);
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'buildingName' => 'required|string|max:255',
            'room' => 'required|integer',
            'capacity' => 'required|integer',
            'facilityRoomDate' => 'required|date_format:m/d/Y',
            'facilityRoomType' => 'required|string|in:Instructional,Laboratory,Office',
            'schoolYear' => 'required|string|max:255',
        ]);

        // Check if the room already exists
        $existingRoom = Room::where('BldName', $validatedData['buildingName'])
                            ->where('Room', $validatedData['room'])
                            ->first();

        if ($existingRoom) {
            return response()->json([
                'message' => 'The room already exists!'
            ], 422); // HTTP 422 Unprocessable Entity
        }

        // Convert the 'facilityRoomDate' to 'Y-m-d' format
        $facilityRoomDate = Carbon::createFromFormat('m/d/Y', $validatedData['facilityRoomDate'])->format('Y-m-d');

        // Create a new room entry
        $room = new Room();
        $room->BldName = $validatedData['buildingName'];
        $room->Room = $validatedData['room'];
        $room->facilityStatus = 'Available';
        $room->Capacity = $validatedData['capacity'];
        $room->facilityRoomDate = $facilityRoomDate;  
        $room->facilityRoomType = $validatedData['facilityRoomType'];  
        $room->schoolYear = $validatedData['schoolYear'];
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
                'schoolYear'=> $room->schoolYear,
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
        $apiResponse = Http::get('https://bhnhs-sis-api-v1.onrender.com/api/v1/sis/section/rooms/schoolYear');

        // Decode the API response
        $apiData = $apiResponse->json();

        // Data Processing
        $combinedRooms = collect($apiData)->map(function ($room) {
            return [
                'facilityStatus' => $room['facilityStatus'],
                'BldName' => $room['BldName'],              
                'Room' => $room['Room'],                    
                'capacity' => $room['currentEnrollment'] . '/' . $room['Capacity'], 
                'session' => $room['session'],             
                'assigned' => $room['gradeLevel'] . ' - ' . $room['sectionName'], 
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

    public function getBuildingAndRooms()
    {
        // Fetch unique buildings and associated rooms
        $rooms = Room::select('BldName', 'Room' , 'facilityRoomType')->get();

        return response()->json($rooms); // Return as JSON for frontend
    }

    public function getRoomsBySchoolYear(Request $request)
    {
        $schoolYear = $request->query('schoolYear');
    
        if ($schoolYear) {
            $rooms = Room::where('schoolYear', $schoolYear)->get();
        } else {
            $rooms = Room::all();
        }
    
        // Return the filtered rooms as JSON
        return response()->json([
            'rooms' => $rooms,
        ]);
    }
    
    public function deleteRoom(Request $request)
    {
        $roomId = $request->input('id');
        $room = Room::findOrFail($roomId);

        // Fetch the API response for sections with rooms
        $response = Http::get('https://bhnhs-sis-api-v1.onrender.com/api/v1/sis/section/rooms/schoolYear');
        $foundSections = $response->json()['foundSections'] ?? [];

        // Check if the room has any assigned sessions or sections
        foreach ($foundSections as $section) {
            if (isset($section['roomId']) && $section['roomId'] == $roomId) {
                // If a session or section is found, prevent deletion
                if (!empty($section['session']) || !empty($section['sectionName'])) {
                    return response()->json(['message' => 'Room cannot be deleted as it has assigned sessions or sections.'], 400);
                }
            }
        }

        // Check if the room has any active relationships with sessions or sections
        $assignedSessions = $room->sessions()->count(); // Adjust this if the relationship is different

        if ($assignedSessions > 0) {
            return response()->json(['message' => 'Room cannot be deleted as it has assigned sessions.'], 400);
        }

        // If no assigned sessions or sections, delete the room
        $room->delete();

        return response()->json(['message' => 'Room deleted successfully.']);
    }


}
