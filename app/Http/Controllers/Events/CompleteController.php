<?php

namespace App\Http\Controllers\Events;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Events\CompleteReq;

class CompleteController extends Controller
{
    public function index() {
        $events = CompleteReq::all();
    
        // Pass the $events variable to the view
        return view('adminPages.admin_eventsComRequest', compact('events'));
    }

    

}
