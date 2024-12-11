<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FacilityModule\RoomController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/roomdetails', [RoomController::class, 'room'])->name('room.details');
Route::get('/v1/rooms', [RoomController::class, 'getRoomsBySchoolYear']);