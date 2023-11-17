<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\AuthController;

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

Route::middleware(['auth:sanctum'])->group(function () {
    // Route Employees Method Get (Get All Resource)
    Route::get('/employees', [EmployeesController::class, 'index']);

    // Route Employees Method Post (Add Resource)
    Route::post('/employees', [EmployeesController::class, 'store']);

    // Route Employees Method Get (Get Detail Resource)
    Route::get('/employees/{id}', [EmployeesController::class, 'show']);

    // Route Employees Method Put (Edit Resource)
    Route::put('/employees/{id}', [EmployeesController::class, 'update']);

    // Route Employees Method Delete (Delete Resource)
    Route::delete('/employees/{id}', [EmployeesController::class, 'destroy']);

    // Route Employees Method Get (Search Resource by Name)
    Route::get('/employees/search/{name}', [EmployeesController::class, 'search']);

    // Route Employees Method Get (Get Active Resource)
    Route::get('/employees/status/active', [EmployeesController::class, 'active']);

    // Route Employees Method Get (Get Inactive Resource)
    Route::get('/employees/status/inactive', [EmployeesController::class, 'inactive']);

    // Route Employees Method Get (Get Terminated Resource)
    Route::get('/employees/status/terminated', [EmployeesController::class, 'terminated']);
});

// Route Auth Method Post
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
