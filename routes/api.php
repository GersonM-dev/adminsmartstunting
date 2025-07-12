<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\AnakController;
use App\Http\Controllers\Api\BeritaController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\RiwayatController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->apiResource('anak', AnakController::class);

Route::middleware('auth:sanctum')->apiResource('riwayat', RiwayatController::class);

Route::middleware('auth:sanctum')->apiResource('berita', BeritaController::class);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show']);
    Route::put('/profile', [ProfileController::class, 'update']);
});