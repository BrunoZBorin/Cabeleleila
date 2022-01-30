<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FoneController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\AttendanceController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('/fones', FoneController::class);
Route::resource('/clients', ClientController::class);
Route::resource('/services', ServiceController::class);
Route::resource('/attendances', AttendanceController::class);
Route::get('/fones/search/{numero}', [FoneController::class, 'search']);
Route::get('/clients/searchEmail/{email}', [ClientController::class, 'searchEmail']);
Route::get('/searchAttendances/{id}', [AttendanceController::class, 'searchAttendances']);
