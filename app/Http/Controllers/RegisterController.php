<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register()
    {
        return view('register');
    }


    public function registerPost(Request $request)
    {

        Log::info('Form Data:', $request->all());
        
        $request->validate([
            'staff_id' => 'required|string|max:255|unique:staff',
            'email' => 'required|string|email|max:255|unique:staff',
            'password' => 'required|string|min:8',
        ]);
        
        Staff::create([
            'staff_id' => $request->input('staff_id'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        return redirect()->route('staff_login')->with('success', 'Registered successfully');
    }
}
