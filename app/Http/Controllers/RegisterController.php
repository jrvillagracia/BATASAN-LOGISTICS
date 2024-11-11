<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Employees;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class RegisterController extends Controller
{
    public function register()
    {
        return view('register');
    }

    public function login()
    {
        return view('employee_login');
    }

    public function index(Request $request)
    {

        return view('admin_dashboard');
    }

    public function registerPost(Request $request)
    {

        Log::info('Form Data:', $request->all());
        
        $request->validate([
            'employee_id' => [
                'required',
                'string',
                'max:255',
                'unique:employees',
                'regex:/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&#])[A-Za-z\d@$!%*?&#]{8,}$/'
            ],
            'email' => 'required|string|email|max:255|unique:employees',
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&#])[A-Za-z\d@$!%*?&#]{8,}$/'
            ],
        ]);
        
        Employees::create([
            'employee_id' => $request->input('employee_id'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Registered successfully',
            'redirect' => route('employee_login') // Include the redirect URL
        ]);
    }

    public function checkAvailability(Request $request)
    {
        $employeeIdExists = Employees::where('employee_id', $request->employee_id)->exists();
        $emailExists = Employees::where('email', $request->email)->exists();

        return response()->json([
            'exists' => [
                'employee_id' => $employeeIdExists,
                'email' => $emailExists
            ]
        ]);
    }

    public function checkLogin(Request $request)
    {
        $user = Employees::where('employee_id', $request->employee_id)->first();

        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                // Authentication was successful
                Auth::login($user);
                return response()->json(['success' => true, 'redirect' => '/admin/dashboard']);
            } else {
                // Wrong password
                return response()->json(['success' => false, 'message' => 'Wrong password']);
            }
        } else {
            // Invalid Employee ID
            return response()->json(['success' => false, 'message' => 'Invalid Employee ID']);
        }
    }

}
