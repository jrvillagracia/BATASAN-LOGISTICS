<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SuppliesController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\Events\ApproveController;
use App\Http\Controllers\Events\ApprovalController;
use App\Http\Controllers\Events\CompleteController;
use App\Http\Controllers\FacilityModule\RoomController;

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


// USED MODULE FOR EQUIPMENT
Route::get('/admin_equipUsed', function () {
    return view('admin_equipUsed');
})->name('admin_equipUsed');


// HISTORY FOR EQUIPMENT
Route::get('/admin_equipHistory', function () {
    return view('admin_equipHistory');
})->name('admin_equipHistory');

// HISTORY FOR SUPPLIES
Route::get('/admin_suppliesHistory', function () {
    return view('admin_suppliesHistory');
})->name('admin_suppliesHistory');


// USED FOR SUPPLIES
Route::get('/admin_suppliesUsed', function () {
    return view('admin_suppliesUsed');
})->name('admin_suppliesUsed');



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




// // FACILITY MODULE FOR REGULAR ROOM
// Route::get('/admin_facilityRegRoom', function () {
//     return view('admin_facilityRegRoom');
// })->name('admin_facilityRegRoom');



// // FACILITY MODULE FOR MORNING SPECIAL ROOM
// Route::get('/admin_facilitySpecRoom', function () {
//     return view('admin_facilitySpecRoom');
// })->name('admin_facilitySpecRoom');



//Register
Route::get('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/register', [RegisterController::class, 'registerPost'])->name('register.post');
Route::post('/register/check', [RegisterController::class, 'checkAvailability'])->name('register.check');

//Login
Route::post('/login/check', [RegisterController::class, 'checkLogin'])->name('login.check');
Route::get('/admin/dashboard', [RegisterController::class, 'index'])->name('admin.dashboard');
Route::get('/employee/login', [RegisterController::class, 'login'])->name('employee_login');


//Equipment
Route::get('/admin_equipment', [EquipmentController::class, 'index'])->name('admin_equipment');
Route::get('/equipment/details', [EquipmentController::class,'equipmentDetails'])->name('equipment.details');
Route::post('/equipment/store', [EquipmentController::class, 'store'])->name('equipment.store');
Route::post('/equipment/delete', [EquipmentController::class, 'destroy'])->name('equipment.destroy');
Route::post('/equipment/delete-view', [EquipmentController::class, 'destroyEdit2'])->name('equipment.destroy2');
Route::post('/equipment/update-main', [EquipmentController::class, 'updateMain'])->name('equipment.updateMain');
Route::post('/equipment/update-view', [EquipmentController::class, 'updateView'])->name('equipment.updateView');
Route::get('/equipment/final-viewing', [EquipmentController::class, 'finalViewing'])->name('equipment.finalViewing');



//Supplies
Route::get('/admin_supplies', [SuppliesController::class, 'index'])->name('admin_supplies');
Route::get('/supplies/details', [SuppliesController::class,'suppliesDetails'])->name('supplies.details');
Route::post('/supplies/store', [SuppliesController::class, 'store'])->name('supplies.store');
Route::post('/supplies/delete', [SuppliesController::class, 'destroy'])->name('supplies.destroy');
Route::post('/supplies/delete-view', [SuppliesController::class, 'destroyEdit2'])->name('equipment.destroy2');
Route::post('/supplies/update-main', [SuppliesController::class, 'updateMain'])->name('supplies.updateMain');
Route::post('/supplies/update-view', [SuppliesController::class, 'updateView'])->name('equipment.updateView');
Route::get('/supplies/final-viewing', [SuppliesController::class, 'finalViewing'])->name('supplies.finalViewing');


//Room
Route::get('/admin_facilityRegRoom', [RoomController::class, 'index'])->name('admin_facilityRegRoom');
Route::get('/admin_facilitySpecRoom', [RoomController::class, 'specialIndex'])->name('admin_facilitySpecRoom');
Route::post('/rooms/store', [RoomController::class, 'store'])->name('room.store');

//Events and Activities
Route::post('/events/store', [ApprovalController::class, 'store'])->name('events.store');
Route::get('/admin_eventsForApproval', [ApprovalController::class, 'index'])->name('admin_eventsForApproval');
Route::get('/apr/event/details', [ApprovalController::class, 'getEventDetails'])->name('event_details');
Route::post('/events/approve', [ApprovalController::class, 'approve'])->name('events.approve');
Route::post('/events/decline', [ApprovalController::class, 'decline'])->name('events.decline');

//Approve Request
Route::get('/admin_eventsAprRequest', [ApproveController::class, 'index'])->name('admin_eventsAprRequest');
Route::get('/event/details', [ApproveController::class, 'getEventDetails'])->name('events_details');
Route::get('/events_Apr_details', [ApproveController::class, 'getEventDetails'])->name('events_Apr_details');
Route::post('/cancel-event', [ApproveController::class, 'cancel'])->name('cancel.event');



//Complete Request
Route::get('/admin_eventsComRequest', [CompleteController::class, 'index'])->name('admin_eventsComRequest');


// OFFICE ROOM
Route::get('/admin_facilityOfficeRoom', function () {
    return view('admin_facilityOfficeRoom');
})->name('admin_facilityOfficeRoom');



// FACULTY PAGES
Route::get('/faculty_home', function () {
    return view('facultyPages.faculty_home');
})->name('faculty_home');



// MAINTENANCE INVENTORY
Route::get('/admin_mainteInventory', function () {
    return view('adminPages.admin_mainteInventory');
})->name('admin_mainteInventory');


// EVENT AND ACTIVITIES FOR HISTORY
Route::get('/admin_eventsHistory', function () {
    return view('adminPages.admin_eventsHistory');
})->name('admin_eventsHistory');