<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DokumenController;
use App\Http\Controllers\KegiatanController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['jwt.auth', 'jwt.refresh'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/dokumen', [DokumenController::class, 'store']);
    Route::delete('/dokumen/{id}', [DokumenController::class, 'destroy']);
    Route::post('/kegiatan', [KegiatanController::class, 'store']);
});
