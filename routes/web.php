<?php

use Illuminate\Support\Facades\Route;

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