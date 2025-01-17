<?php

use Illuminate\Http\Request;
use App\Exports\EquipmentExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JWTApiTokenController;
use App\Http\Controllers\Events\ApproveController;
use App\Http\Controllers\Events\ApprovalController;
use App\Http\Controllers\Events\CompleteController;
use App\Http\Controllers\Supplies\SuppliesController;
use App\Http\Controllers\FacilityModule\RoomController;
use App\Http\Controllers\Equipments\EquipmentController;
use App\Http\Controllers\Equipments\EquipCondemController;
use App\Http\Controllers\Supplies\SuppliesStockController;
use App\Http\Controllers\Equipments\EquipmentStockController;
use App\Http\Controllers\MaintenanceFacility\MainteFacilityController;
use App\Http\Controllers\MaintenanceFacility\MainteEquipmentController;


Route::get('/logistics', [JWTApiTokenController::class, 'store'])->name('logistics.transition');

Route::middleware("jwt-verify")->group(function() {


    Route::get('/', function () {
        return view('welcome');
    });
    
    // routes/web.php
    Route::get('/register', function () {
        return view('register');
    })->name('register');
    
    Route::get('/employee_login', function () {
        return view('employee_login');
    })->name('employee_login');
    
    Route::get('/admin_dashboard', function (Request $request) 
    {        
        $request->session()->put("token", $request->access_token);
        // dd(session("token"));
        return view('adminPages.admin_dashboard');
    })->name('admin_dashboard');

    Route::get('/admin_dashboard', [DashboardController::class, 'index'])->name('admin_dashboard');
    Route::get('/get-equipment-per-month', [DashboardController::class, 'getEquipmentPerMonth'])->name('get-equipment-per-month');
    
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
    
    Route::get('/admin_AprRequestSupplies', function () {
        return view('admin_AprRequestSupplies');
    })->name('admin_AprRequestSupplies');
    
    Route::get('/admin_com_rqstSupplies', function () {
        return view('admin_com_rqstSupplies');
    })->name('admin_com_rqstSupplies');
    
    
    // REQUEST MODULE FOR EQUIPMENT
    Route::get('/admin_approvalEquipment', function () {
        return view('admin_approvalEquipment');
    })->name('admin_approvalEquipment');
    
    Route::get('/admin_AprRequestEquipment', function () {
        return view('admin_AprRequestEquipment');
    })->name('admin_AprRequestEquipment');
    
    Route::get('/admin_com_rqstEquipment', function () {
        return view('admin_com_rqstEquipment');
    })->name('admin_com_rqstEquipment');
Route::get('/', function () {
    return view('welcome');
});


// routes/web.php
Route::get('/register', function () {
    return view('register');
})->name('register');

Route::get('/employee_login', function () {
    return view('employee_login');
})->name('employee_login');

// Route::get('/admin_dashboard', function () {
//     return view('admin_dashboard');
// })->name('admin_dashboard');

// USED MODULE FOR EQUIPMENT
Route::get('/admin_equipUsed', function () {
    return view('adminPages.admin_equipUsed');
})->name('admin_equipUsed');

// HISTORY FOR SUPPLIES
Route::get('/admin_suppliesHistory', function () {
    return view('adminPages.admin_suppliesHistory');
})->name('admin_suppliesHistory');


// USED FOR SUPPLIES
Route::get('/admin_suppliesUsed', function () {
    return view('adminPages.admin_suppliesUsed');
})->name('admin_suppliesUsed');



// REQUEST MODULE FOR SUPPLIES
Route::get('/admin_REQapprovalSupplies', function () {
    return view('adminPages.admin_REQapprovalSupplies');
})->name('admin_REQapprovalSupplies');

Route::get('/admin_REQAprRequestSupplies', function () {
    return view('adminPages.admin_REQAprRequestSupplies');
})->name('admin_REQAprRequestSupplies');

Route::get('/admin_REQComRequestSupplies', function () {
    return view('adminPages.admin_REQComRequestSupplies');
})->name('admin_REQComRequestSupplies');

Route::get('/admin_REQHistorySupplies', function () {
    return view('adminPages.admin_REQHistorySupplies');
})->name('admin_REQHistorySupplies');

// REQUEST MODULE FOR EQUIPMENT
Route::get('/admin_REQapprovalEquipment', function () {
    return view('adminPages.admin_REQapprovalEquipment');
})->name('admin_REQapprovalEquipment');

Route::get('/admin_REQAprRequestEquipment', function () {
    return view('adminPages.admin_REQAprRequestEquipment');
})->name('admin_REQAprRequestEquipment');

Route::get('/admin_REQComRequestEquipment', function () {
    return view('adminPages.admin_REQComRequestEquipment');
})->name('admin_REQComRequestEquipment');


Route::get('/admin_REQHistoryEquipment', function () {
    return view('adminPages.admin_REQHistoryEquipment');
})->name('admin_REQHistoryEquipment');


//Register
Route::get('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/register', [RegisterController::class, 'registerPost'])->name('register.post');
Route::post('/register/check', [RegisterController::class, 'checkAvailability'])->name('register.check');

//Login
Route::post('/login/check', [RegisterController::class, 'checkLogin'])->name('login.check');
Route::get('/admin/dashboard', [RegisterController::class, 'index'])->name('admin.dashboard');
Route::get('/employee/login', [RegisterController::class, 'login'])->name('employee_login');


//Equipment Stock In
Route::get('/admin_StockInEquipment', [EquipmentController::class, 'index'])->name('admin_StockInEquipment');
Route::post('/equipment/approved', [EquipmentController::class, 'approve'])->name('equipment.approve');
Route::get('/equipment/details', [EquipmentController::class,'equipmentDetails'])->name('equipment.details');
Route::post('/equipment/store', [EquipmentController::class, 'store'])->name('equipment.store');
Route::post('/equipment/delete', [EquipmentController::class, 'destroy'])->name('equipment.destroy');
Route::post('/equipment/delete-view', [EquipmentController::class, 'destroy2'])->name('equipment.destroy2');
Route::post('/equipment/update-main', [EquipmentController::class, 'updateMain'])->name('equipment.updateMain');
Route::post('/equipment/update-view', [EquipmentController::class, 'updateView'])->name('equipment.updateView');
Route::get('/equipment/final-viewing', [EquipmentController::class, 'finalViewing'])->name('equipment.finalViewing');

//Equipment
Route::get('/admin_equipment', [EquipmentStockController::class, 'index'])->name('admin_EQUIPMENT');
Route::get('/equipment/details2', [EquipmentStockController::class, 'equipmentDetails'])->name('equipment.details');
Route::post('/equipment/delete-stock', [EquipmentStockController::class, 'destroyStock'])->name('equipment.destroy-stock');
Route::post('/update/main-table', [EquipmentStockController::class, 'update'])->name('update.equipment');
Route::post('/condemn-equipment', [EquipmentStockController::class, 'condemnEquipment'])->name('condemn.equipment');
Route::get('/get/equipments', [EquipmentStockController::class, 'getAllEquipments'])->name('get.equipments');
Route::get('/export-equipment', function () {
    return Excel::download(new EquipmentExport, 'equipment.xlsx');
})->name('equipment.export');

//Equipment Condemned
Route::get('/admin_equipCondemned', [EquipCondemController::class, 'index'])->name('admin_equipCondemned');
Route::get('/equipment/details3', [EquipCondemController::class, 'equipmentDetails'])->name('equipment.details');


//Supplies Stock in
Route::get('/admin_StockInSupplies', [SuppliesController::class, 'index'])->name('admin_StockInSupplies');
Route::post('/supplies/approved', [SuppliesController::class, 'approve'])->name('supplies.approve');
Route::get('/supplies/details', [SuppliesController::class,'suppliesDetails'])->name('supplies.details');
Route::post('/supplies/store', [SuppliesController::class, 'store'])->name('supplies.store');
Route::post('/supplies/delete', [SuppliesController::class, 'destroy'])->name('supplies.destroy');
Route::post('/supplies/delete-view', [SuppliesController::class, 'destroyEdit2'])->name('equipment.destroy2');
Route::post('/supplies/update-main', [SuppliesController::class, 'updateMain'])->name('supplies.updateMain');
Route::post('/supplies/update-view', [SuppliesController::class, 'updateView'])->name('equipment.updateView');
Route::get('/supplies/final-viewing', [SuppliesController::class, 'finalViewing'])->name('supplies.finalViewing');

//Supplies
Route::get('/admin_supplies', [SuppliesStockController::class, 'index'])->name('admin_supplies');
Route::get('/supplies/details2', [SuppliesStockController::class,'suppliesDetails'])->name('supplies.details2');
Route::post('/suppliesStock/delete', [SuppliesStockController::class, 'destroy'])->name('suppliesStock.destroy');
Route::post('/suppliesStock/update', [SuppliesStockController::class, 'updateSupplies'])->name('suppliesStock.update');
Route::get('/export-supplies', function () {
    return Excel::download(new EquipmentExport, 'supplies.xlsx');
})->name('supplies.export');


//Rooms
Route::get('/admin_facilityRegRoom', [RoomController::class, 'index'])->name('admin_facilityRegRoom');
Route::post('/rooms/store', [RoomController::class, 'store'])->name('room.store');
Route::post('/room/edit', [RoomController::class, 'edit'])->name('room.edit');
Route::get('/api/rooms', [RoomController::class, 'getRoomsBySchoolYear'])->name('room.schoolYear');

Route::get('/admin_facilitySpecRoom', [RoomController::class, 'labindex'])->name('admin_facilitySpecRoom');
Route::post('/room/lab/edit', [RoomController::class, 'edit'])->name('room.lab.edit');
Route::post('/rooms/lab/store', [RoomController::class, 'store'])->name('rooms.lab.store');
Route::get('/buildings-rooms', [RoomController::class, 'getBuildingAndRooms'])->name('getBuildingandRooms');


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
    return view('adminPages.admin_facilityOfficeRoom');
})->name('admin_facilityOfficeRoom');

//Maintenance Facility
Route::get('/admin_mainteFacility', [MainteFacilityController::class, 'index'])->name('admin_mainteFacility');
Route::post('/admin/mainteFacility/store', [MainteFacilityController::class, 'store'])->name('mainteFacility.store');
Route::post('/mainte-facility/details', [MainteFacilityController::class, 'showDetails'])->name('mainte.facility.details');

//Maintenance Equipment
Route::get('/admin_mainteEquipment', [MainteEquipmentController::class, 'index'])->name('admin_mainteEquipment');
Route::get('/admin_mainteEquipment/details', [MainteEquipmentController::class, 'showDetails'])->name('maintenance.details');
Route::post('/mainteEquipment/store', [MainteEquipmentController::class, 'store'])->name('mainteEquipment.store'); 


// FACULTY PAGES
Route::get('/faculty_home', function () {
    return view('facultyPages.faculty_home');
})->name('faculty_home');



// MAINTENANCE For Repair INVENTORY
Route::get('/admin_mainteForRepEquip', function () {
    return view('adminPages.admin_mainteForRepEquip');
})->name('admin_mainteForRepEquip');

// MAINTENANCE COMPLETED REQUEST INVENTORY
Route::get('/admin_ComReqMainteEquip', function () {
    return view('adminPages.admin_ComReqMainteEquip');
})->name('admin_ComReqMainteEquip');

// MAINTENANCE HISTORY INVENTORY
Route::get('/admin_HistoryMainteEquip', function () {
    return view('adminPages.admin_HistoryMainteEquip');
})->name('admin_HistoryMainteEquip');

// MAINTENANCE For Repair FACILITY
Route::get('/admin_mainteForRepFacility', function () {
    return view('adminPages.admin_mainteForRepFacility');
})->name('admin_mainteForRepFacility');

// MAINTENANCE COMPLETED REQUEST FACILITY
Route::get('/admin_ComReqMainteFacility', function () {
    return view('adminPages.admin_ComReqMainteFacility');
})->name('admin_ComReqMainteFacility');

// MAINTENANCE HISOTRY FACILITY
Route::get('/admin_HistoryMainteFacility', function () {
    return view('adminPages.admin_HistoryMainteFacility');
})->name('admin_HistoryMainteFacility');

// EVENT AND ACTIVITIES FOR HISTORY
Route::get('/admin_eventsHistory', function () {
    return view('adminPages.admin_eventsHistory');
})->name('admin_eventsHistory');

    Route::post('/logout', function(Request $request){

        // dd('sanity check'); 

        Session::remove("token");

        return redirect()->away("http://192.168.2.237:9901/faculty/login");
    });

});


// PRODUCT ORDER FOR APPROVAL
Route::get('/admin_POInventory', function () {
    return view('adminPages.admin_POInventory');
})->name('admin_POInventory');

// PRODUCT ORDER APPROVE ORDER
Route::get('/admin_POApprOrderInventory', function () {
    return view('adminPages.admin_POApprOrderInventory');
})->name('admin_POApprOrderInventory');

// PRODUCT ORDER COMPLETED ORDER
Route::get('/admin_POCompleteOrderInventory', function () {
    return view('adminPages.admin_POCompleteOrderInventory');
})->name('admin_POCompleteOrderInventory');