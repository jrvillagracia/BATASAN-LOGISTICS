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


// CONDEMNED MODULE FOR EQUIPMENT
Route::get('/admin_equipCondemned', function () {
    return view('admin_equipCondemned');
})->name('admin_equipCondemned');

// CONDEMNED MODULE FOR SUPPLIES
Route::get('/admin_supplyCondemned', function () {
    return view('admin_supplyCondemned');
})->name('admin_supplyCondemned');


// REQUEST MODULE FOR SUPPLIES
Route::get('/admin_approvalSupplies', function () {
    return view('admin_approvalSupplies');
})->name('admin_approvalSupplies');

Route::get('/admin_releaseSupplies', function () {
    return view('admin_releaseSupplies');
})->name('admin_releaseSupplies');

Route::get('/admin_com_rqstSupplies', function () {
    return view('admin_com_rqstSupplies');
})->name('admin_com_rqstSupplies');


// REQUEST MODULE FOR EQUIPMENT
Route::get('/admin_approvalEquipment', function () {
    return view('admin_approvalEquipment');
})->name('admin_approvalEquipment');

Route::get('/admin_releaseEquipment', function () {
    return view('admin_releaseEquipment');
})->name('admin_releaseEquipment');

Route::get('/admin_com_rqstEquipment', function () {
    return view('admin_com_rqstEquipment');
})->name('admin_com_rqstEquipment');


//Register
Route::get('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/register', [RegisterController::class, 'registerPost'])->name('register.post');

//Equipment
Route::get('/admin_equipment', [EquipmentController::class, 'index'])->name('admin_equipment');
Route::post('/equipment/store', [EquipmentController::class, 'store'])->name('equipment.store');
Route::post('/equipment/delete', [EquipmentController::class, 'destroy'])->name('equipment.destroy');
Route::post('/equipment/update', [EquipmentController::class, 'update'])->name('equipment.update');

//Supplies
Route::get('/admin_supplies', [SuppliesController::class, 'index'])->name('admin_supplies');
Route::post('/supplies/store', [SuppliesController::class, 'store'])->name('supplies.store');
Route::post('/supplies/delete', [SuppliesController::class, 'destroy'])->name('supplies.destroy');
Route::post('/supplies/update', [SuppliesController::class, 'update'])->name('supplies.update');


