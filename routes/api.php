<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController as TaskController;
use Illuminate\Support\Facades\Route;

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

// catching the /get to avoid errors in ignition
Route::get('/login', function () {
    return response([
        'message' => 'You need to login first!',
    ], 401);
})->name('login');

/* ! ACTUAL ROUTES */

// * PUBLIC ROUTES
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// * PRIVATE ROUTES
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::resource('/tasks', TaskController::class);
    Route::post('/logout', [AuthController::class, 'logout']);
});
