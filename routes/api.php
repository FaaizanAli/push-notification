<?php

use App\Http\Controllers\GuestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/guest', [GuestController::class, 'store']);
Route::get('/send-notification/{id}', [GuestController::class, 'sendNotification']);
