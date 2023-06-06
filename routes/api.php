<?php

use App\Http\Controllers\ApiAuthController;
use App\Http\Controllers\ApiDataAyamController;
use App\Http\Controllers\ApiDataOvkController;
use App\Http\Controllers\ApiDataPakanController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//login
Route::post('login', [ApiAuthController::class, 'login']);

//data ayam
Route::post('/data-ayam', [ApiDataAyamController::class, 'create']);
Route::get('/data-ayam', [ApiDataAyamController::class, 'read']);
Route::put('/data-ayam/{id}', [ApiDataAyamController::class, 'update']);
Route::delete('/data-ayam/{id}', [ApiDataAyamController::class, 'delete']);

//count jumlah ayam
Route::get('data-ayam-counts', [ApiDataAyamController::class, 'getTotalCounts']);


//data pakan
Route::post('/data-pakan', [ApiDataPakanController::class, 'create']);
Route::get('/data-pakan', [ApiDataPakanController::class, 'read']);
Route::put('/data-pakan/{id}', [ApiDataPakanController::class, 'update']);
Route::delete('/data-pakan/{id}', [ApiDataPakanController::class, 'delete']);

//data pakan minggu ini
Route::get('/data-pakan-weeks', [ApiDataPakanController::class, 'jumlahPakanMingguIni']);

//data pakan bulan ini
Route::get('/data-pakan-month', [ApiDataPakanController::class, 'jumlahPakanBulanIni']);

//stok pakan
Route::get('/data-pakan-stok', [ApiDataPakanController::class, 'stockPakan']);

//data ovk
Route::post('/data-ovk', [ApiDataOvkController::class, 'create']);
Route::get('/data-ovk', [ApiDataOvkController::class, 'read']);
Route::get('/data-ovk-last', [ApiDataOvkController::class, 'readIdTerakhir']);
Route::put('/data-ovk/{id}', [ApiDataOvkController::class, 'update']);
Route::delete('/data-ovk/{id}', [ApiDataOvkController::class, 'delete']);

//logout
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [ApiAuthController::class, 'logout']);
});
