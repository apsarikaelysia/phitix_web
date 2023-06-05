<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DistribusiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GajiController;
use App\Http\Controllers\VaksinController;
use App\Http\Controllers\PakanController;
use App\Http\Controllers\PengeluaranAyamController;
use App\Http\Controllers\PengeluaranPakanController;
use App\Http\Controllers\PengeluaranVaksinController;
use App\Http\Controllers\PengeluaranGajiController;
use App\Http\Controllers\PendapatanController;
use App\Http\Controllers\PenghasilanController;
use App\Http\Controllers\AuthController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('admin.login');
});

Route::get('/login', function () {
    return view('admin.login');
});

Route::get('/index', function () {
    return view('admin.pages.index');
});

Route::get('/dataayam', function () {
    return view('admin.pages.dataayam');
});

Route::get('/datapakan', function () {
    return view('admin.pages.datapakan');
});

Route::get('/dataovk', function () {
    return view('admin.pages.dataovk');
});

Route::get('/datatenagakerja', function () {
    return view('admin.pages.datatenagakerja');
});

Route::get('/datadistribusi', function () {
    return view('admin.pages.datadistribusi');
});

Route::get('/datapengeluaran', function () {
    return view('admin.pages.datapengeluaran');
});

Route::get('/datapendapatan', function () {
    return view('admin.pages.datapendapatan');
});