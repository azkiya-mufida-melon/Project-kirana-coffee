<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StatusPesananController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/menus', \App\Http\Controllers\MenuController::class);
Route::resource('/laporans', \App\Http\Controllers\LaporanController::class);
Route::resource('status_pesanans', StatusPesananController::class);