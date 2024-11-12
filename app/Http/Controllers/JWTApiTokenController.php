<?php

namespace App\Http\Controllers;

use App\Models\JWTApiToken;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class JWTApiTokenController extends Controller
{
    public function store(Request $request){

        // $payload = JWTAuth::setToken($request->access_token)->getPayload();

        session(['token' => $request->access_token]);

        return view('get_token');
    }

    public function get(Request $request){

    }

    public function destroy(Request $request){

    }
}
