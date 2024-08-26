<?php

namespace App\Http\Controllers\FacilityModule;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FacilityModule\RegularRoom;

class RegularRoomController extends Controller
{
    public function roomDetails (Request $request)
    {
        $regRoom = RegularRoom::all();

        return response()->json(['regRoom'=> $regRoom]);
    }
}
