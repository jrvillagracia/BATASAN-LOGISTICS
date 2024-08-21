<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Employees;
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
            'employee_id' => 'required|string|max:255|unique:employees',
            'email' => 'required|string|email|max:255|unique:employees',
            'password' => 'required|string|min:8',
        ]);
        
        Employees::create([
            'employee_id' => $request->input('employee_id'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        return redirect()->route('employee_login')->with('success', 'Registered successfully');
    }
}
