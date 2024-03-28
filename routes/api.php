<?php

use App\Http\Controllers\ProgresseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\UserController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
Route::post('/test-protected', function () {
    return response()->json(['message' => 'This is a protected route']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('/progress')->group(function () {
        Route::get('/my-progress', [ProgresseController::class, 'index']); 
        Route::post('/', [ProgresseController::class, 'store']); 
        Route::delete('/{id}', [ProgresseController::class, 'destroy']); 
        Route::put('/{progress}', [ProgresseController::class, 'update']);
        Route::patch('/{progress}/status', [ProgresseController::class, 'updateStatus']);
        Route::post('/logout', [UserController::class, 'logout']);
    
});
});
Route::post('/auth/register', [AuthController::class, 'createUser']);
Route::post('/auth/login', [AuthController::class, 'loginUser']);




