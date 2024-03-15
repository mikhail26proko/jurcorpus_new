<?php

use App\Http\Controllers\PublicationController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\VacansyController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('branch', BranchController::class)
    ->only(['index','show']);

Route::apiResource('employee', EmployeeController::class)
    ->only(['index','show']);

Route::apiResource('publication', PublicationController::class)
    ->only(['index']);

Route::apiResource('service', ServiceController::class)
    ->only(['index','show']);

Route::apiResource('vacansy', VacansyController::class)
    ->only(['index','show']);

Route::apiResource('lead', LeadController::class)
    ->only(['store']);