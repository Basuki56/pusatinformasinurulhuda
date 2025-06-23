<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DokumenController;
use App\Http\Controllers\KegiatanController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/signin', [AuthController::class, 'login']);

Route::middleware(['jwt.auth', 'jwt.refresh'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/dokumen', [DokumenController::class, 'store']);
    Route::delete('/dokumen/{id}', [DokumenController::class, 'destroy']);
    Route::post('/kegiatan', [KegiatanController::class, 'store']);
});
