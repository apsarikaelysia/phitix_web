<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AyamController;
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


route::get('/', [AuthController::class, 'index']);
route::get('/login', [AuthController::class, 'index'])->middleware('IsStay');
route::post('/login', [AuthController::class, 'authenticate'])->middleware('IsStay');
route::get('/logout', [AuthController::class, 'logout'])->middleware('IsLogin');
route::post('/update-profile/{id}', [AuthController::class, 'profilupdate'])->middleware('IsLogin');
route::get('/index', [DashboardController::class, 'index'])->middleware('IsLogin');


route::get('/dataayam', [AyamController::class, 'index'])->middleware('IsLogin');
route::post('/dataayam', [AyamController::class, 'store'])->middleware('IsLogin');
route::put('/dataayam/{id}', [AyamController::class, 'update'])->middleware('IsLogin');
route::delete('/dataayam/{id}', [AyamController::class, 'destroy'])->middleware('IsLogin');

route::get('/datadistribusi2', [DistribusiController::class, 'index'])->middleware('IsLogin');
route::post('/datadistribusi2', [DistribusiController::class, 'store'])->middleware('IsLogin');
route::put('/datadistribusi2/{id}', [DistribusiController::class, 'update'])->middleware('IsLogin');
route::delete('/datadistribusi2/{id}', [DistribusiController::class, 'destroy'])->middleware('IsLogin');


Route::get('/datauser', [UserController::class, 'index'])->middleware('IsLogin');
Route::post('/datauser', [UserController::class, 'store'])->middleware('IsLogin');
Route::put('/datauser/{id}', [UserController::class, 'update'])->middleware('IsLogin');
Route::delete('/datauser/{id}', [UserController::class, 'destroy'])->middleware('IsLogin');

// route::get('/datatenagakerja', [GajiController::class, 'index'])->middleware('IsLogin');
// route::post('/datatenagakerja', [GajiController::class, 'store'])->middleware('IsLogin');
// route::put('/datatenagakerja/{id}', [GajiController::class, 'update'])->middleware('IsLogin');
// route::delete('/datatenagakerja/{id}', [GajiController::class, 'destroy'])->middleware('IsLogin');

route::get('/dataovk', [VaksinController::class, 'index'])->middleware('IsLogin');
route::post('/dataovk', [VaksinController::class, 'store'])->middleware('IsLogin');
route::put('/dataovk/{id}', [VaksinController::class, 'update'])->middleware('IsLogin');
route::delete('/dataovk/{id}', [VaksinController::class, 'destroy'])->middleware('IsLogin');

route::get('/datapakan', [PakanController::class, 'index'])->middleware('IsLogin');
route::post('/datapakan', [PakanController::class, 'store'])->middleware('IsLogin');
route::put('/datapakan/{id}', [PakanController::class, 'update'])->middleware('IsLogin');
route::delete('/datapakan/{id}', [PakanController::class, 'destroy'])->middleware('IsLogin');

Route::get('/datapendapatan', [PendapatanController::class, 'index'])->middleware('IsLogin');
Route::get('/datapendapatan/{id}', [PendapatanController::class, 'detailpendapatan'])->middleware('IsLogin');
Route::post('/datapendapatan', [PendapatanController::class, 'store'])->middleware('IsLogin');
Route::put('/datapendapatan/{id}', [PendapatanController::class, 'update'])->middleware('IsLogin');
Route::delete('/datapendapatan/{id}', [PendapatanController::class, 'destroy'])->middleware('IsLogin');

Route::get('/datapengeluaranayam', [PengeluaranAyamController::class, 'index'])->middleware('IsLogin');
Route::get('/datapengeluaranayam/{id}', [PengeluaranAyamController::class, 'pengeluaranayamdetail'])->middleware('IsLogin');
Route::post('/datapengeluaranayam', [PengeluaranAyamController::class, 'store'])->middleware('IsLogin');
Route::put('/datapengeluaranayam/{id}', [PengeluaranAyamController::class, 'update'])->middleware('IsLogin');
Route::delete('/datapengeluaranayam/{id}', [PengeluaranAyamController::class, 'destroy'])->middleware('IsLogin');

Route::get('/datapengeluaranpakan', [PengeluaranPakanController::class, 'index'])->middleware('IsLogin');
Route::get('/datapengeluaranpakan/{id}', [PengeluaranPakanController::class, 'pengeluaranpakandetail'])->middleware('IsLogin');
Route::post('/datapengeluaranpakan', [PengeluaranPakanController::class, 'store'])->middleware('IsLogin');
Route::put('/datapengeluaranpakan/{id}', [PengeluaranPakanController::class, 'update'])->middleware('IsLogin');
Route::delete('/datapengeluaranpakan/{id}', [PengeluaranPakanController::class, 'delete'])->middleware('IsLogin');

Route::get('/datapengeluaranvaksin', [PengeluaranVaksinController::class, 'index'])->middleware('IsLogin');
Route::get('/datapengeluaranvaksin/{id}', [PengeluaranVaksinController::class, 'pengeluaranvaksindetail'])->middleware('IsLogin');
Route::post('/datapengeluaranvaksin', [PengeluaranVaksinController::class, 'store'])->middleware('IsLogin');
Route::put('/datapengeluaranvaksin/{id}', [PengeluaranVaksinController::class, 'update'])->middleware('IsLogin');
Route::delete('/datapengeluaranvaksin/{id}', [PengeluaranVaksinController::class, 'destroy'])->middleware('IsLogin');

// Route::get('/datapengeluarangaji', [PengeluaranGajiController::class, 'index'])->middleware('IsLogin');
// Route::get('/datapengeluarangaji/{id}', [PengeluaranGajiController::class, 'pengeluarangajidetail'])->middleware('IsLogin');
// Route::post('/datapengeluarangaji', [PengeluaranGajiController::class, 'store'])->middleware('IsLogin');
// Route::put('/datapengeluarangaji/{id}', [PengeluaranGajiController::class, 'update'])->middleware('IsLogin');
// Route::delete('/datapengeluarangaji/{id}', [PengeluaranGajiController::class, 'destroy'])->middleware('IsLogin');

route::post('/addiddistribusi', [PendapatanController::class, 'addiddistribusi'])->middleware('IsLogin');
route::delete('/deleteiddistribusi/{id}', [PendapatanController::class, 'deleteiddistribusi'])->middleware('IsLogin');

Route::post('/addidayam', [PengeluaranAyamController::class, 'addidayam'])->middleware('IsLogin');
Route::delete('/deleteidayam/{id}', [PengeluaranAyamController::class, 'deleteidayam'])->middleware('IsLogin');

Route::post('/addidpakan', [PengeluaranPakanController::class, 'addipakan'])->middleware('IsLogin');
Route::delete('/deleteidpakan/{id}', [PengeluaranPakanController::class, 'deleteipakan'])->middleware('IsLogin');

Route::post('/addidvaksin', [PengeluaranVaksinController::class, 'addidvaksin'])->middleware('IsLogin');
Route::delete('/deleteidvaksin/{id}', [PengeluaranVaksinController::class, 'deleteidvaksin'])->middleware('IsLogin');

// Route::post('/addidgaji', [PengeluaranGajiController::class, 'addidgaji'])->middleware('IsLogin');
// Route::delete('/deleteidgaji/{id}', [PengeluaranGajiController::class, 'deleteidgaji'])->middleware('IsLogin');

Route::get('/datapenghasilan', [PenghasilanController::class, 'index'])->middleware('IsLogin');
Route::post('/datapenghasilan', [PenghasilanController::class, 'store'])->middleware('IsLogin');
Route::put('/datapenghasilan/{id}', [PenghasilanController::class, 'update'])->middleware('IsLogin');
Route::delete('/datapenghasilan/{id}', [PenghasilanController::class, 'destroy'])->middleware('IsLogin');