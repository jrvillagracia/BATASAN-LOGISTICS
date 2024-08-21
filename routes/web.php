<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SuppliesController;
use App\Http\Controllers\EquipmentController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin_dashboard', function () {
    return view('admin_dashboard');
})->name('admin_dashboard');

// routes/web.php
Route::get('/register', function () {
    return view('register');
})->name('register');

Route::get('/employee_login', function () {
    return view('employee_login');
})->name('employee_login');

Route::get('/admin_dashboard', function () {
    return view('admin_dashboard');
})->name('admin_dashboard');

//Register
Route::get('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/register', [RegisterController::class, 'registerPost'])->name('register.post');

//Equipment
Route::get('/admin_equipment', [EquipmentController::class, 'index'])->name('admin_equipment');
Route::post('/equipment/store', [EquipmentController::class, 'store'])->name('equipment.store');

//Supplies
Route::get('/admin_supplies', [SuppliesController::class, 'index'])->name('admin_supplies');
Route::post('/supplies/store', [SuppliesController::class, 'store'])->name('supplies.store');
