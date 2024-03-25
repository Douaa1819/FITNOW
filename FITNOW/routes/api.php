<?php

use App\Http\Controllers\ProgresseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\UserController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
Route::post('/auth/register', [AuthController::class, 'createUser']);
Route::post('/auth/login', [AuthController::class, 'loginUser']);
;
Route::prefix('/progress')->group(function () {
    Route::get('/', [ProgresseController::class, 'index']); 
    Route::post('/', [ProgresseController::class, 'store']); 
    Route::delete('/{id}', [ProgresseController::class, 'destroy']); 
    Route::put('/{id}', [ProgresseController::class, 'update']);
});
