<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SupplyController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\EquipmentController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/welcome', function () {
    return view('welcome');
});

// routes/web.php
Route::get('/register', function () {
    return view('register');
})->name('register');

Route::get('/staff_login', function () {
    return view('staff_login');
})->name('staff_login');

Route::get('/admin_dashboard', function () {
    return view('admin_dashboard');
})->name('admin_dashboard');


//Register
Route::get('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/register', [RegisterController::class, 'registerPost'])->name('register.post');


//Inventory
Route::get('/admin_equipment', [EquipmentController::class, 'index'])->name('admin_equipment');
Route::get('/admin_supplies', [SupplyController::class, 'index'])->name('admin_supplies');
Route::post('/supplies/store', [SupplyController::class, 'store'])->name('supplies.store');
Route::post('/equipment/store', [EquipmentController::class, 'store'])->name('equipment.store');

//Delete in Inventory
Route::post('/equipment/delete', [EquipmentController::class, 'destroy'])->name('equipment.destroy');
Route::post('/supplies/delete', [SupplyController::class, 'destroy'])->name('supplies.destroy');


